@include('header')
@extends('header')
@push('title')
    <title>Forgot Password</title>
@endpush

<form action="{{ route('forget.password.link') }}" method="post">
    @csrf
    <section class="vh-100 gradient-custom">

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Forgot Password</h2>
                                <p class="text-white-50 mb-5">Please enter your email</p>
                                @if(Session::has('success'))
                                <p class="alert alert-success">{{ Session::get('success') }}</p>
                                @endif
                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" id="typeEmailX"
                                        class="form-control form-control-lg" placeholder="Email address"
                                        value="{{ old('email') }}" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger"> {{ $errors->first('email') }} </span>
                                    @endif

                                </div>
                            
                                <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                    name="send">Send Link</button>

                            </div>

                            <div>
                                <p class="mb-0">Go back to <a href="{{ route('user-login') }}"
                                        class="text-white-50 fw-bold">Login</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</form>




@include('footer')
