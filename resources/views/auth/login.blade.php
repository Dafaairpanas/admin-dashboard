@extends('layouts.auth', ['title' => 'Login'])

@section('content')
    <div class="card">
        <div class="card-body p-0 bg-primary auth-header-box rounded-top">
            <div class="text-center p-3">
                <a href="{{ route('login') }}" class="logo logo-admin">
                    <img src="/images/BroLogotext.png" height="50" alt="logo" class="auth-logo">
                </a>
                <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Let's Get Started BroSurv</h4>
                <p class="text-white fw-medium mb-0">Sign in to continue to BroSurv Admin.</p>
            </div>
        </div>
        <div class="card-body pt-0">
            <form class="my-4" method="POST" action="{{ route('login') }}">

                @csrf
                @if (sizeof($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <p class="text-danger mb-3">{{ $error }}</p>
                    @endforeach
                @endif

                <div class="form-group mb-2">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email"
                           name="email" value="demo@user.com">
                </div><!--end form-group-->

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"
                           placeholder="Enter password" value="password">
                </div><!--end form-group-->

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i>
                            </button>
                        </div>
                    </div><!--end col-->
                </div> <!--end form-group-->
            </form><!--end form-->

        </div><!--end card-body-->
    </div><!--end card-->
@endsection
