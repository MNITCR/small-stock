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
            <i class="fa-solid fa-moon fs-2" id="mode-icon"></i>
        </div>

        <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;"">
            <div class="col-md-6">
                <div class="card bg-dark" id="dark-mode-card">
                    <div class="fs-2 text-center fw-bold fst-italic mt-2">{{ __('ទម្រង់ចូល') }}</div>
                    {{-- <div class="mt-2" style="width: 100%;height: 1px;background: rgb(172, 172, 172)"></div> --}}
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="mb-1">
                                    <label for="email">{{ __('អុីម៉ែល') }}</label>
                                </div>
                                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
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

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <div class="mt-2">
                                <p style="font-size: 13px;color:rgb(125, 125, 125)">បើសិនមិនទាន់មានគណនីទេចុចត្រង់<a href="./register">បង្កើតគណនី</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const toggleButton = document.getElementById("toggle-mode");
        const container = document.querySelector(".container-fluid");
        const cards = document.getElementById("dark-mode-card");
        const modeIcon = document.getElementById("mode-icon");

        // Check if user preference is stored in localStorage
        const isDarkMode = localStorage.getItem("darkMode") === "true";

        // Set initial mode based on localStorage or system preference
        if (isDarkMode) {
            container.classList.add("dark-mode");
            cards.classList.add("bg-dark");
        } else {
            container.classList.add("light-mode");
            cards.classList.add("bg-white");
        }

        toggleButton.addEventListener("click", () => {
            if (container.classList.contains("light-mode")) {
                container.classList.remove("light-mode");
                container.classList.add("dark-mode");
                cards.classList.remove("bg-white");
                cards.classList.add("bg-dark");
                modeIcon.classList.remove("fa-moon");
                modeIcon.classList.add("fa-sun");

                // Store the dark mode preference in localStorage
                localStorage.setItem("darkMode", "true");
            } else {
                container.classList.remove("dark-mode");
                container.classList.add("light-mode");
                cards.classList.remove("bg-dark");
                cards.classList.add("bg-white");
                modeIcon.classList.remove("fa-sun");
                modeIcon.classList.add("fa-moon");

                // Remove the dark mode preference from localStorage
                localStorage.setItem("darkMode", "false");
            }
        });
    </script>

@endsection

