<header class="bg-brand-light-gray dark:bg-gray-800 py-3 px-4 lg:px-16  border-b border-gray-300">
    <div class="container mx-auto">
        <div class="flex justify-between items-center">
            <div class="h-10 flex items-center">
                <a href="{{ route('home') }}"><figure class="">
                    <img class="h-8 sm:h-10" src="{{ url('storage' . $logoLink) }}" alt="logo">
                </figure></a>
            </div>
            <div class="pl-2">
                <nav class="flex items-center">
                    <ul class="pr-0 md:pr-10 lg:pr-20 pt-5 md:pt-0 fixed -right-64 md:right-0 top-16 md:top-0 bottom-0 w-56 sm:w-64  md:w-auto bg-gray-800 md:bg-transparent
                    md:relative md:flex transition-all duration-300 ease-in z-40
                    " id="sidebar-menu">
                        <li class="px-5 md:py-0 py-2 md:px-2"><a href="{{ route('home') }}" class="font-semibold  hover:text-gray-300 md:hover:text-black text-base md:text-sm lg:text-base {{ Route::is('home')  ? 'text-gray-600 md:text-black' : 'text-white md:text-gray-600' }}">Home</a></li>

                        <li class="px-5 md:py-0 py-2 md:px-2"><a href="{{ route('newly_listed') }}" class="font-semibold  hover:text-gray-300 md:hover:text-black text-base md:text-sm lg:text-base {{ Route::is('newly_listed')  ? 'text-gray-600 md:text-black' : 'text-white md:text-gray-600' }}">Newly listed</a></li>

                        <li class="px-5 md:py-0 py-2 md:px-2"><a href="{{ route('allnft') }}" class="font-semibold text-white hover:text-gray-300 md:hover:text-black text-base md:text-sm lg:text-base {{ Route::is('allnft')  ? 'text-gray-600 md:text-black' : 'text-white md:text-gray-600' }}">All NFTs</a></li>

                        <li class="px-5 md:py-0 py-2 md:px-2"><a href="{{ route('prelaunch') }}" class="font-semibold hover:text-gray-300 md:hover:text-black text-base md:text-sm lg:text-base {{ Route::is('prelaunch')  ? 'text-gray-600 md:text-black' : 'text-white md:text-gray-600' }}">Prelaunch </a></li>

                        @foreach($header_menus as $menu)
                            <li class="px-5 md:py-0 py-2 md:px-2"><a href="{{ route('page.show', $menu->slug) }}" class="font-semibold text-white md:text-gray-600 hover:text-gray-300 md:hover:text-black text-base md:text-sm lg:text-base">{{ $menu->title }} </a></li>
                        @endforeach
                    </ul>
                    <div class="flex items-center">
                        @guest
                            <div class="relative my-2" >
                                <a class="font-semibold text-sm sm:text-base md:text-sm lg:text-base mr-2 sm:mr-3 uppercase text-gray-600 hover:text-black" href="{{ route('login') }}">Login</a>
                                <a class="font-semibold text-sm  sm:text-base md:text-sm lg:text-base uppercase text-gray-600 hover:text-black" href="{{ route('register') }}">Sign Up</a>
                            </div>
                        @endguest
                        @auth
                        <div class="ml-6 relative">
                            <div class="flex items-center relative"  id="dropdown--handler">
                                <ul class="w-40 border-r bg-white absolute rounded right-0 shadow top-0 mt-12 hidden z-30" id="menu--handler">
                                    <li class="border-b cursor-pointer w-full py-3 px-4 hover:bg-gray-100 transition-all duration-300">
                                       <a href="{{ route('profile') }}">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                <circle cx="12" cy="7" r="4" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            </svg>
                                            <span class="ml-2">  Profile</span>
                                        </div>
                                       </a>
                                    </li>
                                    <li class="border-b cursor-pointer w-full py-3 px-4 hover:bg-gray-100 transition-all duration-300">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                                    <path d="M7 12h14l-3 -3m0 6l3 -3" />
                                                  </svg>
                                                <span class="ml-2">  Logout</span>
                                            </div>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                                <div class="cursor-pointer flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out">
                                    <img class="rounded-full h-8 w-8 object-cover" src="{{ asset('images/avatar.png') }}" alt="logo" />
                                </div>
                                <div class="text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down cursor-pointer" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @endauth
                        <div class="ml-3 md:hidden">
                           <div class="cursor-pointer" id="show--menu-bar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="4" y1="6" x2="20" y2="6" />
                                    <line x1="4" y1="12" x2="20" y2="12" />
                                    <line x1="4" y1="18" x2="20" y2="18" />
                                </svg>
                           </div>
                           <div class="cursor-pointer hidden" id="show--menu-times">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="4" y="4" width="16" height="16" rx="2" />
                                <path d="M10 10l4 4m0 -4l-4 4" />
                              </svg>
                           </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
