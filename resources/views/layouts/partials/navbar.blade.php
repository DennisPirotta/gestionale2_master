<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="grid grid-cols-3">
            <div class="flex items-center justify-start">
                <a href="{{ route('dashboard.index') }}" class="flex ml-2 md:mr-24">
                    <x-application-logo/>
                    <span class="self-center text-xl font-semibold hidden md:block whitespace-nowrap dark:text-white">Gestionale</span>
                </a>
            </div>

            <div class="flex items-center justify-center">
                <ol class="md:inline-flex items-center space-x-1 md:space-x-3 hidden">
                    <li class="inline-flex items-center">
                        <a href="{{ route('welcome') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Home
                        </a>
                    </li>
                    {{ $path }}
                </ol>
            </div>

            <div class="relative text-left flex items-center justify-end">

                <div
                    class="inline-flex items-stretch rounded-md"
                    x-data="{ isActive: false }"
                >
                    <div class="relative">

                        <button
                            class="flex items-center text-sm font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:mr-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                            type="button"
                            x-on:click="isActive = !isActive"
                        >
                            <span class="sr-only">Open user menu</span>
                            @if(auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage').'/'.auth()->user()->profile_photo_path }}" alt="{{ auth()->user()->name }}" class="mr-2 rounded-full h-8 w-8 object-cover">
                            @else
                                <div class="mr-2 relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                    <span class="font-medium text-gray-600 dark:text-gray-300">{{ auth()->user()->name[0] }}</span>
                                </div>
                            @endif
                            {{ auth()->user()->name }} {{ auth()->user()->surname }}
                            <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>

                        <div
                            class="overflow-hidden absolute right-0 z-10 mt-4 w-56 origin-top-right rounded-md border border-gray-100 bg-white shadow-lg"
                            role="menu"
                            x-cloak
                            x-transition
                            x-show="isActive"
                            x-on:click.away="isActive = false"
                            x-on:keydown.escape.window="isActive = false"
                        >
                            <div class="flow-root py-2">
                                <div class="-my-2 divide-y divide-gray-200">
                                    <div class="p-2">
                                        <strong
                                            class="block p-2 text-xs font-medium uppercase text-gray-400"
                                        >
                                            Generale
                                        </strong>

                                        <a
                                            href="#"
                                            class="flex items-center block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                            role="menuitem"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
                                            </svg>
                                            Archivio
                                        </a>


                                        <a
                                            href="#"
                                            class="flex items-center block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                            role="menuitem"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 12.75c1.148 0 2.278.08 3.383.237 1.037.146 1.866.966 1.866 2.013 0 3.728-2.35 6.75-5.25 6.75S6.75 18.728 6.75 15c0-1.046.83-1.867 1.866-2.013A24.204 24.204 0 0112 12.75zm0 0c2.883 0 5.647.508 8.207 1.44a23.91 23.91 0 01-1.152 6.06M12 12.75c-2.883 0-5.647.508-8.208 1.44.125 2.104.52 4.136 1.153 6.06M12 12.75a2.25 2.25 0 002.248-2.354M12 12.75a2.25 2.25 0 01-2.248-2.354M12 8.25c.995 0 1.971-.08 2.922-.236.403-.066.74-.358.795-.762a3.778 3.778 0 00-.399-2.25M12 8.25c-.995 0-1.97-.08-2.922-.236-.402-.066-.74-.358-.795-.762a3.734 3.734 0 01.4-2.253M12 8.25a2.25 2.25 0 00-2.248 2.146M12 8.25a2.25 2.25 0 012.248 2.146M8.683 5a6.032 6.032 0 01-1.155-1.002c.07-.63.27-1.222.574-1.747m.581 2.749A3.75 3.75 0 0115.318 5m0 0c.427-.283.815-.62 1.155-.999a4.471 4.471 0 00-.575-1.752M4.921 6a24.048 24.048 0 00-.392 3.314c1.668.546 3.416.914 5.223 1.082M19.08 6c.205 1.08.337 2.187.392 3.314a23.882 23.882 0 01-5.223 1.082"></path>
                                            </svg>
                                            Bug Report
                                        </a>
                                    </div>

                                    <div class="p-2">
                                        <strong
                                            class="block p-2 text-xs font-medium uppercase text-gray-400"
                                        >
                                            Profilo
                                        </strong>

                                        <a
                                            href="{{ route('profile.show') }}"
                                            class="flex items-center block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                            role="menuitem"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Impostazioni
                                        </a>

                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="w-full flex items-center block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                                role="menuitem"
                                            >
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path>
                                                </svg>
                                                Esci
                                            </button>
                                        </form>
                                    </div>

                                    <div class="p-2">
                                        <strong
                                            class="block p-2 text-xs font-medium uppercase text-gray-400"
                                        >
                                            Amministrazione
                                        </strong>

                                        <a
                                            href="#"
                                            class="flex items-center block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                            role="menuitem"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"></path>
                                            </svg>
                                            Chiavi di accesso
                                        </a>
                                    </div>

                                    <div class="p-2">
                                        <strong
                                            class="block p-2 text-xs font-medium uppercase text-gray-400"
                                        >
                                            Sviluppo
                                        </strong>

                                        <a
                                            href="#"
                                            class="flex items-center block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                            role="menuitem"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" d="M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 10-2.636 6.364M16.5 12V8.25"></path>
                                            </svg>
                                            Gestione Mail
                                        </a>

                                        <a
                                            href="#"
                                            class="flex items-center block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
                                            role="menuitem"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 6.75v10.5a2.25 2.25 0 002.25 2.25zm.75-12h9v9h-9v-9z"></path>
                                            </svg>
                                            Gestione Log
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>
