<?php

use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use ProfileValidationRules, WithFileUploads;

    public function rendering($view)
    {
        return $view->layout('layouts.dashboard');
    }

    public string $name = '';
    public string $username = '';
    public string $email = '';
    public $photo;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->username = $user->username ?? '';
        $this->email = $user->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'], // 1MB Max
        ]);

        $user->fill([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($this->photo) {
            $user->profile_photo_path = $this->photo->store('profile-photos', 'public');
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
        session()->flash('message', 'Profile updated successfully.');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        return Auth::user() instanceof MustVerifyEmail && ! Auth::user()->hasVerifiedEmail();
    }
}; ?>

<x-pages::settings.layout :heading="__('Profile Information')" :subheading="__('Update your name, username, and profile picture')">
    <form wire:submit="updateProfileInformation" class="space-y-8 animate-in fade-in transition-all duration-500">
        <!-- Profile Photo Section -->
        <div class="bg-white/80 backdrop-blur-md p-6 rounded-3xl border border-[#dcc5ae] shadow-sm flex flex-col items-center md:items-start md:flex-row gap-8">
            <div class="relative group">
                <!-- Avatar Preview -->
                <div class="w-24 h-24 md:w-28 md:h-28 rounded-full border-4 border-[#ebd9c8] overflow-hidden bg-[#fcf8f4] shadow-inner relative">
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ Auth::user()->profile_photo_url }}" class="w-full h-full object-cover">
                    @endif
                    
                    <!-- Loading Overlay -->
                    <div wire:loading wire:target="photo" class="absolute inset-0 bg-black/40 backdrop-blur-[2px] flex items-center justify-center">
                        <div class="w-6 h-6 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    </div>
                </div>

                <!-- Upload Button -->
                <label class="absolute bottom-0 right-0 bg-[#8c5319] hover:bg-[#6d4013] text-white p-2 rounded-full shadow-lg cursor-pointer transition-all duration-300 transform group-hover:scale-110 border-2 border-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15a2.25 2.25 0 002.25-2.25V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                    </svg>
                    <input type="file" wire:model="photo" class="hidden" accept="image/*">
                </label>
            </div>

            <div class="flex-1 space-y-2 text-center md:text-left">
                <h4 class="text-xs font-black text-[#8a7663] uppercase tracking-widest">Avatar Photo</h4>
                <p class="text-[0.65rem] text-[#a08f80] italic leading-relaxed">
                    Personalize your account with a profile picture.<br>Supports JPG, PNG (Max 1MB).
                </p>
                @error('photo') <span class="text-[0.65rem] text-red-500 font-medium">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="bg-white/80 backdrop-blur-md p-6 md:p-8 rounded-3xl border border-[#dcc5ae] shadow-sm space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-[#8a7663] uppercase tracking-wide">Display Name</label>
                    <div class="relative">
                        <input type="text" wire:model="name" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] transition-all" placeholder="Enter your full name">
                    </div>
                    @error('name') <span class="text-[0.65rem] text-red-500 font-medium italic">{{ $message }}</span> @enderror
                </div>

                <!-- Username -->
                <div class="space-y-1.5">
                    <label class="text-xs font-black text-[#8a7663] uppercase tracking-wide">Username</label>
                    <div class="relative">
                        <input type="text" wire:model="username" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] transition-all" placeholder="Enter your username">
                    </div>
                    @error('username') <span class="text-[0.65rem] text-red-500 font-medium italic">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="space-y-1.5">
                <label class="text-xs font-black text-[#8a7663] uppercase tracking-wide">Email Address</label>
                <div class="relative">
                    <input type="email" wire:model="email" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] focus:ring-1 focus:ring-[#8c5319] transition-all" placeholder="Enter your email">
                </div>
                @error('email') <span class="text-[0.65rem] text-red-500 font-medium italic">{{ $message }}</span> @enderror
            </div>

            <div class="pt-6 flex justify-end items-center gap-3 border-t border-[#ebd9c8]">
                <x-action-message class="text-xs font-bold text-green-600 mr-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>

                <button type="submit" class="px-10 py-2.5 rounded-xl text-xs font-bold text-white bg-[#8c5319] hover:bg-[#6d4013] shadow-lg shadow-[#8c5319]/20 transition-all flex items-center gap-2">
                    <span wire:loading.remove wire:target="updateProfileInformation">Save Profile</span>
                    <span wire:loading wire:target="updateProfileInformation" class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                </button>
            </div>
        </div>
    </form>
</x-pages::settings.layout>
