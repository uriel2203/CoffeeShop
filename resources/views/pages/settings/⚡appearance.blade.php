<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component {
    public function rendering($view)
    {
        return $view->layout('layouts.dashboard');
    }
    //
}; ?>

<x-pages::settings.layout :heading="__('Appearance')" :subheading="__('Update the appearance settings for your account')">
    <div class="bg-white/80 backdrop-blur-md p-8 rounded-3xl border border-[#dcc5ae] shadow-sm">
        <div class="space-y-6">
            <h4 class="text-xs font-black text-[#8a7663] uppercase tracking-widest mb-4 text-center md:text-left">Select Theme</h4>
            
            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance" class="w-full">
                <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
                <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
                <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
            </flux:radio.group>
            
            <p class="text-[0.65rem] text-[#a08f80] mt-6 text-center md:text-left italic leading-relaxed">
                Choose between light, dark, or follow your system preferences.
            </p>
        </div>
    </div>
</x-pages::settings.layout>
