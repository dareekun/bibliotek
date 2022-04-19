<x-guest-layout>
    <div id="auth-left">
        <div class="auth-logo">
            <a href="/"><img src="{{ asset('/images/logo/logo.png') }}" alt="Logo"></a>
        </div>

        <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group position-relative has-icon-left mb-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="form-control form-control-xl" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="form-group position-relative has-icon-left mb-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="form-control form-control-xl" type="password" name="password" required autocomplete="new-password" />
            </div>
            
            <div class="form-group position-relative has-icon-left mb-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="form-control form-control-xl" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send Password Reset Link</button>
        </form>
    </div>
</x-guest-layout>