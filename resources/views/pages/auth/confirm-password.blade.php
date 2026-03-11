@component('layouts.dashboard')
    <x-pages::settings.layout :heading="__('Confirm Access')" :subheading="__('This is a secure area of the application. Please confirm your password before continuing.')">
        <div class="bg-white/80 backdrop-blur-md p-6 md:p-8 rounded-3xl border border-[#dcc5ae] shadow-sm">
            <x-auth-session-status class="text-center mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('password.confirm.store') }}" class="space-y-6">
                @csrf

                <div class="space-y-1.5">
                    <label class="text-xs font-black text-[#8a7663] uppercase tracking-wide">Enter Password</label>
                    <input type="password" 
                        name="password" 
                        class="w-full bg-[#fcf8f4] border border-[#dcc5ae] rounded-xl py-3 px-4 text-sm focus:outline-none focus:border-[#8c5319] transition-all" 
                        required 
                        autocomplete="current-password"
                        placeholder="••••••••">
                    @error('password') <span class="text-[0.65rem] text-red-500 font-medium italic">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center gap-4 pt-6 border-t border-[#ebd9c8]">
                    <button type="submit" class="px-10 py-2.5 rounded-xl text-xs font-bold text-white bg-[#8c5319] hover:bg-[#6d4013] shadow-lg shadow-[#8c5319]/20 transition-all flex items-center gap-2">
                        <span>Confirm Password</span>
                    </button>
                </div>
            </form>
        </div>
    </x-pages::settings.layout>
@endcomponent
