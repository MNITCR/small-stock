@extends('link.links')

@section('title', 'Login Page')
<style>
    /* Light mode styles */
    .light-mode {
        background-color: white;
        color: black;
    }

    /* Dark mode styles */
    .dark-mode {
        background-color: #121212; /* Dark background color */
        color: white; /* Light text color */
    }
    .dark-mode * {
        color: white;
    }
    .dark-mode-card{
        background-color: #121212; /* Dark background color */
        color: white; /* Light text color */
    }
</style>

@section('content')
    <div class="container-fluid light-mode">
        <div class="mt-3 d-flex justify-content-end me-auto" id="toggle-mode" style="position: absolute; cursor: pointer;right: 2rem;">
            <i class="fa-solid fs-2" id="mode-icon"></i>
        </div>

        <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;"">
            <div class="col-md-6">
                <div class="card bg-dark" id="dark-mode-card">
                    <div class="fs-2 text-center fw-bold fst-italic mt-2">{{ __('ទម្រង់ចូល') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="email">{{ __('អុីម៉ែល') }}</label>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback mt-1 mb-1" role="alert">
                                        <strong style="font-size: 10px" class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <div class="mb-1">
                                    <label for="password">{{ __('ពាក្យសម្ងាត់') }}</label>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('ចង់ចាំខ្ញុំ') }}
                                    </label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">{{ __('ចូល') }}</button>
                            </div>

                            @if ($errors->has('email') || $errors->has('password'))
                                <div class="alert alert-danger mt-3">
                                    អ៊ី​ម៉ែ​ល​ឬ​ពាក្យសម្ងាត់​មិន​ត្រឹមត្រូវ
                                    <a href="#" data-toggle="modal" id="forgotPasswordModal">ភ្លេច​លេខសំងាត់​?</a>
                                </div>
                            @endif

                            <div class="mt-2">
                                <p style="font-size: 13px;color:rgb(125, 125, 125)">បើសិនមិនទាន់មានគណនីទេចុចត្រង់<a href="./register">បង្កើតគណនី</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Forgot Password Modal -->
        <div class="modal fade" id="PasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="forgotPasswordModalLabel">ភ្លេច​លេខសំងាត់​?</h5>
                        <div id="closeModalButton" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark fs-5 text-dark"></i></span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right text-dark">{{ __('អាស័យ​ដ្ឋាន​អ៊ី​ម៉េ​ល') }}</label>
                                <div class="col-md-6 text-dark">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback mt-1 mb-1" role="alert">
                                            <strong style="font-size: 10px" class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="font-size: 13px">
                                        {{ __('ផ្ញើតំណកំណត់ពាក្យសម្ងាត់ឡើងវិញ') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection

