<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ManageUsers extends Component
{
    use WithPagination;

    /** 
     * Search and Filter properties
     * These are bound to the UI inputs to allow real-time filtering of the user table.
     */
    public $search = '';         // Text search for Name, Username, or Email
    public $statusFilter = 'all'; // Filter by Account Status (all, active, inactive)
    public $roleFilter = 'all';   // Filter by System Role (all, admin, employee)

    /** 
     * Form properties
     * These hold the data for the create/edit modal.
     */
    public $userId = null;       // ID of the user being edited (null for new users)
    public $name = '';           // Full Name field
    public $username = '';       // Unique Username field
    public $email = '';          // Email field
    public $role = 'employee';   // Selected role (Default: employee)
    public $password = '';       // Password field (only used when set)
    public $status = 1;          // 1 = Active, 0 = Inactive (matches select values)

    /** 
     * UI State
     */
    public $showModal = false;    // Controls visibility of the Add/Edit modal

    /**
     * resetPage() ensures that when a user searches or filters, 
     * we go back to the first page of results to avoid "empty page" issues.
     */
    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }
    public function updatingRoleFilter() { $this->resetPage(); }

    /**
     * Opens the modal in "Create" mode.
     * Clears previous form data to ensure a fresh start.
     */
    public function createUser()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    /**
     * Opens the modal in "Edit" mode.
     * Loads the existing user data into the form properties.
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->status = $user->status ? 1 : 0; 
        $this->password = ''; 
        $this->showModal = true;
    }

    /**
     * Resets all form fields to their default state.
     * Called after saving or when opening the "Create" modal.
     */
    private function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->username = '';
        $this->email = '';
        $this->role = 'employee';
        $this->password = '';
        $this->status = 1;
    }

    /**
     * Saves the user data to the database.
     * Handles both Creating a new user and Updating an existing one.
     */
    public function save()
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->userId)],
            'role' => 'required|in:admin,employee',
            'status' => 'required|in:1,0',
        ];

        // Password is only required for new members
        if (!$this->userId) {
            $rules['password'] = 'required|min:8';
        } else {
            $rules['password'] = 'nullable|min:8';
        }

        $this->validate($rules);

        // Determine if this is an update or a fresh creation
        $isUpdate = $this->userId !== null;

        if ($isUpdate) {
            $user = User::findOrFail($this->userId);
        } else {
            $user = new User();
        }

        // Apply properties to the model
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->status = (int) $this->status;

        // Hash the password if it was provided
        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        // Close modal and refresh UI
        $this->showModal = false;
        $this->resetForm();
        
        session()->flash('message', $isUpdate ? 'Account updated successfully.' : 'Account created successfully.');
    }

    /**
     * Toggles the user's Active/Inactive status directly from the table.
     * This provides a quick way to disable accounts without opening the editor.
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        
        // Flip the status (1 to 0 or 0 to 1)
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        $user->refresh();
        
        session()->flash('message', "Account for {$user->username} is now " . ($user->status == 1 ? 'Active' : 'Inactive') . ".");
    }
    
    /**
     * Deletes a user account.
     * Protected against self-deletion and primary admin deletion.
     */
    public function deleteUser($id)
    {
        if ($id === 1 || $id === auth()->id()) {
            session()->flash('error', 'This account cannot be deleted for security reasons.');
            return;
        }

        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('message', 'User account permanently removed.');
    }

    /**
     * Main render function that fetches the user list.
     * Applies all active filters (search, role, status) and handles pagination.
     */
    public function render()
    {
        $query = User::query()
            // Apply Search Filtering (Name, Username, or Email)
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('username', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            // Apply Status Filtering (Active vs Inactive)
            ->when($this->statusFilter !== 'all', function ($q) {
                $q->where('status', $this->statusFilter === 'active' ? 1 : 0);
            })
            // Apply Role Filtering (Admin vs Employee)
            ->when($this->roleFilter !== 'all', function ($q) {
                $q->where('role', $this->roleFilter);
            });

        // Return the view with the filtered and sorted list
        return view('livewire.dashboard.manage-users', [
            'users' => $query->orderBy('id', 'asc')->paginate(10)
        ])->layout('layouts.dashboard');
    }
}
