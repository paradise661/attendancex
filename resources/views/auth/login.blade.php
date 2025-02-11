<!DOCTYPE html>
<html class="light" data-nav-layout="vertical" data-vertical-style="overlay" data-header-styles="light"
    data-menu-styles="light" data-toggled="close" lang="en" dir="ltr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sajilo Attendance | Login </title>
    <meta name="description"
        content="Paradise Infotech Sajilo Attendance system is a cutting-edge solution for managing employee attendance efficiently. Designed for accuracy, scalability, and ease of use.">
    <meta name="keywords"
        content="Paradise Infotech, Sajilo Attendance system, attendance management, employee attendance software, time tracking, admin dashboard, responsive system, attendance solutions, Paradise attendance system, AttendanceX">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/brand-logos/fav.jpg') }}">
    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/authentication-main.js') }}"></script>

    <!-- Style Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Simplebar Css -->
    <link id="style" href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Swiper Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">

</head>

<body class="min-h-screen bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="flex justify-center items-center min-h-screen">
            <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <!-- Logo Section -->
                    <div class="flex justify-center mb-6">
                        <img class="desktop-logo h-16 w-auto" src="{{ asset('assets/images/logo.png') }}"
                            alt="logo">
                    </div>

                    <!-- Sign-In Heading -->
                    <p class="text-2xl font-semibold text-center text-gray-800 dark:text-white mb-2">Sign In</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">
                        Welcome back, Admin!
                    </p>

                    @if (session('error'))
                        <div
                            class="alert alert-danger flex items-center p-4 mb-4 rounded-lg bg-red-100 text-red-700 border border-red-400">
                            <svg class="flex-shrink-0 me-2 fill-danger" xmlns="http://www.w3.org/2000/svg"
                                enable-background="new 0 0 24 24" height="1.5rem" viewBox="0 0 24 24" width="1.5rem"
                                fill="#e53e3e">
                                <g>
                                    <rect fill="none" height="24" width="24" />
                                </g>
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M15.73,3H8.27L3,8.27v7.46L8.27,21h7.46L21,15.73V8.27L15.73,3z M19,14.9L14.9,19H9.1L5,14.9V9.1L9.1,5h5.8L19,9.1V14.9z" />
                                            <rect height="6" width="2" x="11" y="7" />
                                            <rect height="2" width="2" x="11" y="15" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <div class="ml-2">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <div class="space-y-4">
                        <!-- Email Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                for="signin-username">Email Address</label>
                            <input
                                class="w-full border border-gray-300 dark:border-gray-700 rounded-md p-3 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                id="signin-username" type="text" value="{{ old('email') }}"
                                placeholder="Enter your email" name="email">

                            @error('email')
                                <div
                                    class="flex items-center p-2 text-sm text-red-600 bg-red-50 border-l-4 border-red-500 rounded-md">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
                                    </svg>
                                    <div class="text-red-600">
                                        <i class="font-normal">{{ $message }}</i>
                                    </div>
                                </div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                                for="signin-password">Password

                            </label>
                            <div class="flex items-center border border-gray-300 dark:border-gray-700 rounded-md">
                                <input
                                    class="flex-1 p-3 border border-gray-300 dark:border-gray-700 text-sm rounded-l-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    id="signin-password" type="password" placeholder="Enter your password"
                                    name="password">

                                <button
                                    class="p-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-r-md"
                                    type="button" onclick="createpassword('signin-password',this)">
                                    <i class="ri-eye-off-line"></i>
                                </button>

                            </div>
                            @error('password')
                                <div
                                    class="flex items-center p-2 text-sm text-red-600 bg-red-50 border-l-4 border-red-500 rounded-md">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
                                    </svg>
                                    <div class="text-red-600">
                                        <i class="font-normal">{{ $message }}</i>
                                    </div>
                                </div>
                            @enderror

                            <div class="mt-4">
                                <a class="text-sm text-blue-500 hover:underline mt-4" href="javascript:void(0)">Forgot
                                    password?</a>
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button
                                class="w-full bg-blue-500 text-white font-medium py-3 rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 transition"
                                type="submit">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Show Password JS -->
    <script src="{{ asset('assets/js/show-password.js') }}"></script>

    <!-- Auth Custom JS -->
    <script src="{{ asset('assets/js/auth-custom.js') }}"></script>
</body>

</html>
