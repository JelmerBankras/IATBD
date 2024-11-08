<header class="w-full py-4 lg:py-8 transition-[transform,padding,background-color] bg-secondary">
    <div class="o-container">
        <div class="flex items-center justify-between gap-12 lg:h-[50px]">
            <a href="{{ url('/') }}" class="relative flex w-full h-auto max-h-[70px] max-w-[150px] md:max-w-[200px] md:max-h-[90px] focus:outline-0 focus:text-gray-light transition-colors">
                <img src="{{ asset('images/logo.png') }}" class="h-auto w-full" alt="">
            </a>
            <nav id="navigation" class="flex flex-col fixed top-0 right-0 z-40 translate-x-full ml-auto w-[450px] max-w-full h-full bg-white pt-24 lg:pt-0 lg:bg-transparent lg:translate-x-0 lg:min-h-0 lg:w-auto lg:h-auto lg:static ">
                <div class="overflow-x-hidden overflow-y-auto w-full h-full px-8 lg:px-0">
                    <ul class="flex flex-col gap-6 lg:flex-row lg:justify-center">
                        <li>
                            @if(auth()->check())
                                <a href="{{ route('profile') }}" class="block leading-7 text-white text-xl font-bold underline-offset-[.35em] decoration-1 hover:underline focus:outline-0 transition-colors lg:text-body">
                                    My profile
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </nav>
            @guest
                <!-- If the user is not logged in, show the Login/Register links -->
                <x-button link="{{ route('login') }}" text="Login" class="c-btn c-btn-primary"/>
            @else
            <div class="flex flex-col gap-2">
                <span class="text-white text-sm">Welcome, {{ Auth::user()->name }}</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="c-btn c-btn-primary c-btn-small">Logout</button>
                </form>
            </div>
            @endguest
        </div>
    </div>
</header>
