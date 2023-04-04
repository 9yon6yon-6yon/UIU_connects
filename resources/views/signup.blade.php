@include('header')
@extends('header')
@push('title')
    <title>Sign Up</title>
@endpush
<form method="POST" action="{{ route('user-sign-up') }}">
    @csrf
    <section class="vh-100 gradient-custom">

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Create new account</h2>
                                <p class="text-white-50 mb-5">Please enter your information here!</p>
                                @if(Session::has('success'))
                                <p class="alert alert-success">{{ Session::get('success') }}</p>
                                @endif
                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" id="typeEmailX"
                                        class="form-control form-control-lg" placeholder="Email address" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger"> {{ $errors->first('email') }} </span>
                                    @endif

                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password" id="typePasswordX"
                                        class="form-control form-control-lg" placeholder="Password" />
                                    @if ($errors->has('password'))
                                        <span class="text-danger"> {{ $errors->first('password') }} </span>
                                    @endif

                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password_confirmation" id="typePasswordX"
                                        class="form-control form-control-lg" placeholder="Confirm Password" />
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger"> {{ $errors->first('password_confirmation') }} </span>
                                    @endif

                                </div>
                                <div class="form-outline form-white mb-4">
                                    <select id="user_type" name="type" class="custom-select">
                                        <option value="student">Student</option>
                                        <option value="teacher">Faculty</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div>
                                    <input id="condition-checkbox" class="form-check-input me-2" type="checkbox"
                                        value="" name="condition" required />
                                    <label>
                                        I agree all statements in <a href="{{ url('/') }}"
                                            class="text-white-50"><u>Terms of
                                                service</u></a>
                                    </label><br>
                                    @if ($errors->has('condition'))
                                        <span class="text-danger"> {{ $errors->first('condition') }} </span>
                                    @endif
                                </div>
                                <br>
                                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="signup"
                                    id="signup-btn">Signup</button>


                            </div>

                            <div>
                                <p class="mb-0">Already have an account? <a href="{{ route('user-login') }}"
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
