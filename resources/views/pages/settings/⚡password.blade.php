<?php

use App\Concerns\PasswordValidationRules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component {
    use PasswordValidationRules;

    public function rendering($view)
    {
        return $view->layout('layouts.dashboard');
    }

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => $this->currentPasswordRules(),
                'password' => $this->passwordRules(),
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => $validated['password'],
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<x-pages::settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
    <div class="bg-white/80 backdrop-blur-md p-6 md:p-8 rounded-3xl border border-[#dcc5ae] shadow-sm">
        <form method="POST" wire:submit="updatePassword" class="space-y-6">
            <div class="space-y-1.5">
                <label class="text-xs font-black text-[#8a7663] uppercase tracking-wide">Current Password</label>
                <input type="password" wire:model="current_password" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] transition-all" required autocomplete="current-password">
                @error('current_password') <span class="text-[0.65rem] text-red-500 font-medium italic">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-black text-[#8a7663] uppercase tracking-wide">New Password</label>
                <input type="password" wire:model="password" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] transition-all" required autocomplete="new-password">
                @error('password') <span class="text-[0.65rem] text-red-500 font-medium italic">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-black text-[#8a7663] uppercase tracking-wide">Confirm New Password</label>
                <input type="password" wire:model="password_confirmation" class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] transition-all" required autocomplete="new-password">
                @error('password_confirmation') <span class="text-[0.65rem] text-red-500 font-medium italic">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center gap-4 pt-6 border-t border-[#ebd9c8]">
                <button type="submit" class="px-10 py-2.5 rounded-xl text-xs font-bold text-white bg-[#8c5319] hover:bg-[#6d4013] shadow-lg shadow-[#8c5319]/20 transition-all flex items-center gap-2">
                    <span>Save Password</span>
                </button>

                <x-action-message class="text-xs font-bold text-green-600" on="password-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </div>
</x-pages::settings.layout>
