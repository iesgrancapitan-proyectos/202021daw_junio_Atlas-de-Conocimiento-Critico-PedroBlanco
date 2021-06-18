<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @guest
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('/') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('/') }}" :active="request()->routeIs('/')">
                        {{ __('Inicio') }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('atlas') }}" :active="request()->routeIs('atlas')">
                        {{ __('Atlas') }}
                    </x-jet-nav-link>
                </div>
            </div>
            <div class="flex float-right">
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('messages.LogIn') }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('atlas') }}" :active="request()->routeIs('register')">
                        {{ __('messages.Register') }}
                    </x-jet-nav-link>
                </div>
            </div>
            {{-- <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ __('Visitante') }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                <x-jet-dropdown-link href="{{ route('login') }}">
                                    {{ __('messages.LogIn') }}
                                </x-jet-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                @if (Route::has('register'))
                                <x-jet-dropdown-link href="{{ route('register') }}">
                                    {{ __('messages.Register') }}
                                </x-jet-dropdown-link>
                                @endif
                            </div>
                            @endif
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div> --}}

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        @else
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('messages.Dashboard') }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('autor') }}" :active="request()->routeIs('autor')">
                        {{ trans_choice('Autor', 2) }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('administracion') }}" :active="request()->routeIs('administracion')">
                        {{ trans_choice('Administración', 2) }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('ambito') }}" :active="request()->routeIs('ambito')">
                        {{ trans_choice('Ámbito', 2) }}
                    </x-jet-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('estado') }}" :active="request()->routeIs('estado')">
                        {{ trans_choice('Estado', 2) }}
                    </x-jet-nav-link>
                </div>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-jet-nav-link href="{{ route('geo') }}" :active="request()->routeIs('geo')">
                    {{ trans_choice('Localización', 2) }}
                </x-jet-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-jet-nav-link href="{{ route('mapa') }}" :active="request()->routeIs('mapa')">
                    {{ trans_choice('Mapa', 2) }}
                </x-jet-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                {{-- @if ( (null !== auth()->user()->role()->first()) && ((auth()->user()->role()->first()->nombre == 'Administrador') || (auth()->user()->role()->first()->nombre == 'SuperAdministrador')) ) --}}
                @can('viewAny', \App\Models\User::class)
                    <x-jet-nav-link href="{{ route('livewire.users') }}" :active="request()->routeIs('livewire.users')">
                        {{ __('messages.Users') }}
                    </x-jet-nav-link>
                @endcan
                {{-- @endif --}}
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('messages.manage_account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('messages.Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('message.API_Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('messages.LogOut') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        @endguest
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @guest
        <div class="pt-2 pb-2 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('/') }}" :active="request()->routeIs('/')">
                {{ __('Inicio') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="pt-1 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('atlas') }}" :active="request()->routeIs('atlas')">
                    {{ __('Atlas') }}
                </x-jet-responsive-nav-link>
            </div>
        </div>
        <div class="pt-1 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Route::has('login'))
                    <x-jet-responsive-nav-link href="{{ route('login') }}">
                        {{ __('messages.LogIn') }}
                    </x-jet-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-jet-responsive-nav-link href="{{ route('register') }}">
                            {{ __('messages.Register') }}
                        </x-jet-responsive-nav-link>
                    @endif
                @endif
            </div>
        </div>
        @else
        <div class="pt-2 pb-2 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('messages.Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>

        <div class="pt-1 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('autor') }}" :active="request()->routeIs('autor')">
                    {{ trans_choice('Autor', 2) }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('administracion') }}" :active="request()->routeIs('administracion')">
                    {{ trans_choice('Administración', 2) }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('ambito') }}" :active="request()->routeIs('ambito')">
                    {{ trans_choice('Ámbito', 2) }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('estado') }}" :active="request()->routeIs('estado')">
                    {{ trans_choice('Estado', 2) }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('geo') }}" :active="request()->routeIs('geo')">
                    {{ trans_choice('Localización', 2) }}
                </x-jet-responsive-nav-link>
                <x-jet-responsive-nav-link href="{{ route('mapa') }}" :active="request()->routeIs('mapa')">
                    {{ trans_choice('Mapa', 2) }}
                </x-jet-responsive-nav-link>
            </div>
        </div>

        <div class="pt-1 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                @can('viewAny', \App\Models\User::class)
                <x-jet-responsive-nav-link href="{{ route('livewire.users') }}" :active="request()->routeIs('livewire.users')">
                    {{ __('messages.Users') }}
                </x-jet-responsive-nav-link>
                @endcan
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-1 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('messages.Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('messages.API_Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('messages.LogOut') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        </div>
        @endguest
    </div>
</nav>
