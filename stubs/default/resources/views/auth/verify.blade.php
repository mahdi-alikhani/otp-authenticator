<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('verify') }}">
        @csrf

        <!-- Username Address -->
        <div>
            <x-input-label for="code" :value="__('Verification code')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code"
                :value="old('code')" required autofocus />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Verify') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
