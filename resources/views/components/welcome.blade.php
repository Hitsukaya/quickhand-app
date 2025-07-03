<div class="select-none p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-4">
        {{-- Left Column: User Profile --}}
        <div class="lg:col-span-1">
            <div class="p-6 bg-white border border-gray-200  rounded-xl shadow-sm">
                <div class="flex flex-col items-center text-center">
                    {{-- Avatar --}}
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-24 h-24 rounded-full object-cover border-2 border-indigo-500">

                    {{-- Name & Email --}}
                    <h2 class="mt-4 text-xl font-bold text-gray-900">
                        {{ Auth::user()->name }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ Auth::user()->email }}
                    </p>

                    {{-- Location --}}
                    @if(Auth::user()->location)
                        <p class="mt-1 text-sm text-gray-500">
                            📍 {{ Auth::user()->location }}
                        </p>
                    @endif

                    {{-- Member Since --}}
                    <p class="mt-1 text-sm text-gray-500">
                        Joined {{ Auth::user()->created_at->format('F j, Y') }}
                    </p>

                    {{-- Edit Button --}}
                    <a href="{{ route('profile.show') }}"
                       class="mt-4 inline-flex items-center px-4 py-2 bg-red-600 text-white hover:text-white text-sm font-medium rounded-md hover:bg-red-700 transition">
                        <x-heroicon-o-pencil class="w-4 h-4 mr-1" /> Edit Profile
                    </a>
                </div>

                {{-- Bio --}}
                @if(Auth::user()->bio)
                <div class="mt-6 text-left">
                    <h3 class="text-sm font-semibold text-gray-700">About</h3>
                    <p class="mt-2 text-gray-600 text-sm leading-relaxed">
                        {{ Auth::user()->bio }}
                    </p>
                </div>
                @endif
            </div>
        </div>

        {{-- Right Column: Stats --}}
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Total Logins --}}
            <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-200">
                <div class="flex items-center">
                    <x-heroicon-o-plus-circle class="w-5 h-5 text-gray-800"/>
                    <span class="ml-2 text-sm font-bold text-gray-800">Adauga anunt</span><br>
                </div>
                 <span class="ml-2 text-sm text-black py-2">Posteaza un anunt pentru a cere ajutor.</span>
            <div class="flex justify-center items-center py-2">
                 <a href="{{ route('ad.create') }}" type="button" class="relative bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-4 py-2 rounded-2xl transition duration-150 flex items-center justify-center">
                    <x-heroicon-s-plus class="w-5 h-5 mr-2" />
                    <span wire:loading.remove>Adauga anunt</span>
                    <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </a>
            </div>
            </div>

            {{-- Last Login --}}
            {{-- <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-200">
                <div class="flex items-center">
                    <x-heroicon-o-clock class="w-5 h-5 text-red-600 dark:text-red-500"/>
                    <span class="ml-2 text-sm text-gray-600">Last login</span>
                </div>
                <p class="mt-2 text-xl font-semibold text-gray-900 dark:text-white">
                    {{ \Carbon\Carbon::parse(Auth::user()->last_login_at)->diffForHumans() }}
                </p>
            </div> --}}

            {{-- Total Logins --}}
            <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-200">
                <div class="flex items-center">
                    <x-heroicon-o-finger-print class="w-5 h-5 text-red-600 dark:text-red-500"/>
                    <span class="ml-2 text-sm text-gray-600">Statistici</span>
                </div>
                <div class="mt-2 text-xl font-semibold text-gray-900">
                <p>Total aplicarii: {{ auth()->user()->total_applications_count ?? 0 }}</p>
                 <p>Total anunțuri publicate: {{ \App\Models\Ad::where('user_id', auth()->id())->count() }}</p>
                </div>
            </div>

            {{-- Exta Functionality --}}
            {{-- @if(auth()->user()->role === 'ADMIN' || auth()->user()->role === 'EDITOR')
                <div class="bg-white dark:bg-neutral-900 rounded-xl shadow-sm p-5 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <x-heroicon-o-cog class="w-5 h-5 text-red-600 dark:text-red-500"/>
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Extra Functionality</span>
                    </div>
                    <p class="mt-2 text-xl py-2 font-semibold text-gray-900 dark:text-white">
                        <x-cache-clear />
                    </p>
                </div>
            @endif --}}

            {{-- Two Factor Authentication --}}
            <div class="bg-white  rounded-xl shadow-sm p-5 border border-gray-200">
                <div class="flex items-center">
                    <x-heroicon-o-user-circle class="w-5 h-5 text-indigo-600"/>
                    <span class="ml-2 text-sm text-gray-600">Two Factor Authentication</span>
                </div>
                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>
                @endif
            </div>

            {{-- Browser Sessions --}}
            <div class="bg-white  rounded-xl shadow-sm p-5 border border-gray-200">
                <div class="flex items-center">
                    <x-heroicon-o-user-circle class="w-5 h-5 text-indigo-600"/>
                    <span class="ml-2 text-sm text-gray-600">Browser Sessions</span>
                </div>
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>
            </div>

            {{-- Browser Sessions --}}
            {{-- <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-200">
                <div class="flex items-center">
                    <x-heroicon-o-user-circle class="w-5 h-5 text-indigo-600"/>
                    <span class="ml-2 text-sm text-gray-600">Browser Sessions</span>
                </div>
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>
            </div> --}}
        </div>
    </div>




</div>
