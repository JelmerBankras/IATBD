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
</html>
@include('sections.header')
<body>
    <div class="relative z-0 overflow-hidden py-20">
        <img src="{{ asset('images/header.jpg') }}" class="absolute inset-0 -z-10 object-center w-full" alt="">
        <div class="o-container z-10">
            <div class="bg-white p-12 rounded-md max-w-[500px] w-full flex flex-col gap-8">
                @if(auth()->user())
                    @if(auth()->user()->role == 'owner')
                        <h1 class="text-5xl text-gradient font-bold">Voeg je eigen huisdier toe!</h1>
                        <form class="c-form bg-gray-200 rounded-md w-full p-4" action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf <!-- Token for Laravel form protection -->
                            <div class="inline-flex flex-col gap-2 justify-start">
                                <label class="c-form-label" for="name">Pet Name:</label>
                                <input class="c-form-input" type="text" id="name" name="name" required>
                            </div>
                            <div class="inline-flex flex-col gap-2 justify-start">
                                <label class="c-form-label" for="species">Species:</label>
                                <input class="c-form-input" type="text" id="species" name="species" required>
                            </div>

                            <div class="inline-flex flex-col gap-2 justify-start">
                                <label class="c-form-label" for="age">Age:</label>
                                <input class="c-form-input" type="number" id="age" name="age" required>
                            </div>

                            <div class="inline-flex flex-col gap-2 justify-start">
                                <label class="c-form-label" for="image">Image:</label>
                                <input class="c-form-input" type="file" id="image" name="image" required>
                            </div>

                            <button class="c-btn c-btn-primary" type="submit">Add Pet</button>
                        </form>
                    @else
                        <h1 class="text-5xl text-gradient font-bold">Upload foto's van je huis!</h1>
                        <form class="c-form bg-gray-200 rounded-md w-full p-4" action="{{ route('upload.house.images') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="house_images">Upload House Images:</label>
                            <input type="file" name="house_images[]" id="house_images" multiple required>

                            <button class="c-btn c-btn-primary" type="submit">Upload Photos</button>
                        </form>
                    @endif
                @else
                    <h1 class="text-5xl text-gradient font-bold">Je bent nog niet ingelogd</h1>
                    <h2 class="text-2xl text-black">log hier in of ga naar de login page</h2>
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
                    <div class="mt-4">
                        <a href="{{ route('register') }}" class="text-gray-400 underline">
                            Nog geen account? Registreer hier
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
