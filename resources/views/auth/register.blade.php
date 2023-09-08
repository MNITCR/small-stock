@extends('link.links')

@section('title', 'Register Page')

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

        <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6">
                <div class="card bg-dark" id="dark-mode-card">
                    <div class="fs-2 fw-bold fst-italic text-center mt-2">{{ __('ទម្រង់​ ចុះឈ្មោះ') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="name">{{ __('ឈ្មោះ') }}</label>
                                </div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <div class="mb-1">
                                    <label for="email">{{ __('អុីម៉ែល') }}</label>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <div class="mb-1">
                                    <label for="password">{{ __('ពាក្យសម្ងាត់') }}</label>
                                </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-2 mt-2">
                                <div class="mb-1">
                                    <label for="password-confirm">{{ __('បញ្ជាក់ពាក្យសម្ងាត់') }}</label>
                                </div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('ចុះឈ្មោះ') }}
                            </button>
                            <div class="mt-2">
                                <p style="font-size: 13px;color:rgb(125, 125, 125)">បើសិនមានគណនីរួចហើយចុចត្រង់<a href="/">ចូលគណនី</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- link js --}}
    {{-- <script src="{{ asset('js/rejester/rejester.js') }}"></script> --}}

@endsection
