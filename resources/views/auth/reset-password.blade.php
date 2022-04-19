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
                <input type="email" class="form-control form-control-xl" placeholder="Email" :value="old('email', $request->email)" name="email">
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>

            <div class="form-group position-relative has-icon-left mb-4">
                <input id="password" type="password" class="form-control form-control-xl" name="password" required autocomplete="new-password">
                <div class="form-control-icon">
                    <i class="bi bi-key"></i>
                </div>
            </div>
            
            <div class="form-group position-relative has-icon-left mb-4">
                <input id="password" type="password" class="form-control form-control-xl" name="password" required autocomplete="new-password">
                <div class="form-control-icon">
                    <i class="bi bi-key"></i>
                </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send Password Reset Link</button>
        </form>
    </div>
</x-guest-layout>
