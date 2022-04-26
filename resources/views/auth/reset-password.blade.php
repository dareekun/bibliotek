<x-guest-layout>
    <div id="auth-left">
        <div class="auth-logo">
            <a href="/"><img src="{{ asset('/images/logo/logo.png') }}" alt="Logo"></a>
        </div>
        <h1 style="color:white">Update Password</h1>
        <p style="color:white">Please input your new password. </p>
        @if ($errors->any())
        <div class="my-1 text-danger">
           <p> {{ $errors->first() }}</p>
        </div>
        @endif
        <form method="POST" action="{{ route('password_update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="nik" value="{{$nik}}">
            <div class="form-group position-relative has-icon-left mb-4">
                    <input id="password" class="form-control form-control-xl" type="password" name="password" required autocomplete="new-password" />
                    <div class="form-control-icon">
                    <i class="fas fa-key"></i>
                    </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                    <input id="password_confirmation" class="form-control form-control-xl" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <div class="form-control-icon">
                    <i class="fas fa-asterisk"></i>
                    </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Update Password</button>
        </form>
    </div>
</x-guest-layout>