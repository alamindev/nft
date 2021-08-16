<div class="bg-white">
    <ul class="p-5 flex flex-wrap sm:flex-col">
        <li class="w-6/12 sm:w-full">
            <a class="w-full flex items-center py-3 px-3 text-sm sm:text-base border-b hover:bg-gray-100 transition-all duration-300 text-gray-600 {{ (Route::is('profile') || Route::is('profile')) ? 'bg-gray-100' : '' }}" href="{{ route('profile') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user " width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="7" r="4" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                  </svg>
                <span class="pl-2">Profile</span></a>
        </li>
        <li class="w-6/12 sm:w-full">
            <a class="w-full flex items-center py-3 px-3 text-sm sm:text-base border-b border-l sm:border-l-0 hover:bg-gray-100 transition-all duration-300 text-gray-600 {{ (Route::is('projects') || Route::is('projects.create') || Route::is('projects.edit')  ) ? 'bg-gray-100' : '' }}" href="{{ route('projects') }}" >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <rect x="4" y="4" width="6" height="6" rx="1" />
                    <rect x="4" y="14" width="6" height="6" rx="1" />
                    <rect x="14" y="14" width="6" height="6" rx="1" />
                    <line x1="14" y1="7" x2="20" y2="7" />
                    <line x1="17" y1="4" x2="17" y2="10" />
                  </svg>
                  <span class="pl-2">Projects</span></a>
        </li>
        <li class="w-6/12 sm:w-full">
            <a class="w-full flex items-center py-3 px-3 text-sm sm:text-base border-b-0 sm:border-b  hover:bg-gray-100 transition-all duration-300 text-gray-600 {{ (Route::is('ads') || Route::is('ads.create') || Route::is('ads.edit') ) ? 'bg-gray-100' : '' }}" href="{{ route('ads') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ad" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <rect x="3" y="5" width="18" height="14" rx="2" />
                    <path d="M7 15v-4a2 2 0 0 1 4 0v4" />
                    <line x1="7" y1="13" x2="11" y2="13" />
                    <path d="M17 9v6h-1.5a1.5 1.5 0 1 1 1.5 -1.5" />
                  </svg>
                  <span class="pl-2"> Ads</span> </a>
        </li>
        <li class="w-6/12 sm:w-full">
            <a class="w-full flex items-center py-3 px-3 text-sm sm:text-base border-l sm:border-l-0  hover:bg-gray-100 transition-all duration-300 text-gray-600 {{ (Route::is('favourite_lists')) ? 'bg-gray-100' : '' }}" href="{{  route('favourite_lists') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                  </svg>
                  <span class="pl-2"> Favorite list </span></a>
        </li>
    </ul>
</div>
