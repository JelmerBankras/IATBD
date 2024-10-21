<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite('resources/sass/app.scss')
</head>

@include('sections.header')

<div class="container mx-auto mt-10">
    <div class="flex justify-center">
        <div class="w-full max-w-lg my-16">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="text-xl font-semibold text-center mb-4">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="text-red-500 text-sm mt-1 block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Password') }}</label>
                            <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="text-red-500 text-sm mt-1 block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input class="form-checkbox text-blue-600" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">{{ __('Remember Me') }}</span>
                            </label>
                        </div>

                        <!-- Submit Button & Forgot Password Link -->
                        <div class="flex items-center justify-between">
                            <button type="submit" class="c-btn c-btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="mt-4">
                    <a href="{{ route('register') }}" class="text-gray-400 underline">
                        Nog geen account? Registreer hier
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
