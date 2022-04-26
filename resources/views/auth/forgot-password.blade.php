<x-guest-layout>
    <div id="auth-left">
        <div class="auth-logo">
            <a href="/"><img src="{{ asset('/images/logo/logo.png') }}" alt="Logo"></a>
        </div>
        <h1 style="color:white">Forgot Password</h1>
        <p style="color:white">Please input your NIK. </p>
        @if (session('status'))
        <div class="my-1 text-success">
            {{ session('status') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="my-1 text-danger">
            {{ $errors->first() }}
        </div>
        @endif
        <form class="mt-4" action="{{ route('password_reset') }}" method="POST">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" placeholder="NIK" value="{{ old('nik') }}" name="nik">
                <div class="form-control-icon">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send Password Reset Link</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p style="color:white">Remember your account? <a href="{{ route('login')}}" class="font-bold">Log
                    in</a>.
            </p>
        </div>
    </div>
   
</x-guest-layout>
