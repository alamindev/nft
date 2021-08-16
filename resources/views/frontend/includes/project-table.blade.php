<tr>
    <td>
        <a href="{{ route('details', $project->slug) }}" class="flex flex-col sm:flex-row items-center">
            <img class="w-12 md:w-16 h-12 md:h-16 object-cover" src="{{ asset($project->photo) }}"   alt="page-image">
            <p class="pt-1 sm:pt-0 text-xs font-semibold md:text-base pl-1 sm:pl-3 text-center">{{ $project->name }}</p>
        </a>
    </td>

    <td>
        @php
            $date = \Carbon\Carbon::parse($project->launch_date)->format('Y-m-d');
            $time = \Carbon\Carbon::parse($project->launch_time)->format('h:i A');
        @endphp
        <span class="text-xs md:text-sm lg:text-base">{{ $date . ' ' . $time }}</span>
        {{-- \Carbon\Carbon::parse($date . ' ' . $time)->diffForHumans() --}}
    </td>
    <td class="hidden md:flex items-center">
        <div class="flex">
            @if($project->website_link != null)
            <a href="{{ $project->website_link }}" target="_blank"><i class="fas fa-globe-americas p-2 text-indigo-600"></i></a>
            @endif
            @if($project->discord_link != null)
            <a href="{{ $project->discord_link }}" target="_blank" ><i class="fab fa-discord p-2 text-indigo-600"></i></a>
            @endif
            @if($project->twitter_link != null)
            <a  href="{{ $project->twitter_link }}"  target="_blank"    ><i class="fab fa-twitter p-2 text-indigo-600 "></i></a>
            @endif
        </div>
    </td>
    <td class="sm:w-64 md:w-72">
        <div class="flex flex-wrap items-center justify-center">
            @if(auth()->check())
                @if($project->user_id !== auth()->user()->id)
                @php
                    $collection = collect($project->favourite);
                @endphp
                @if($collection->contains('user_id',auth()->user()->id))
                <a href="{{ route('add.unfavourite', $project->id) }}" class="m-0.5 sm:m-1  py-1 md:py-2  px-3  border border-indigo-600 hover:bg-indigo-800 bg-indigo-600 text-white hover:text-white rounded transition-all duration-200 text-sm flex justify-center w-full sm:w-auto"  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                </svg>
                </a>
                @else
                <a href="{{ route('add.favourite', $project->id) }}" class="m-0.5 sm:m-1  py-1 md:py-2  px-3  border border-indigo-600 hover:bg-indigo-600 hover:text-white rounded transition-all duration-200 text-sm flex justify-center w-full sm:w-auto"  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                </svg>
                </a>

                @endif
                @endif
            @else
                <a href="{{ route('add.favourite', $project->id) }}" class="m-0.5 sm:m-1 py-1 md:py-2 px-3  border border-indigo-600 hover:bg-indigo-600 hover:text-white rounded transition-all duration-200 text-sm flex justify-center w-full sm:w-auto"  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                </svg>
                </a>
            @endif
                <a  href="{{ route('details', $project->slug) }}" class="m-0.5 sm:m-1  py-2 px-3  border border-indigo-600 hover:bg-indigo-600 hover:text-white rounded transition-all duration-200 text-xs sm:text-sm md:text-base flex justify-center w-full sm:w-auto"  >Details</a>
            @if(auth()->check())
                @if($project->user_id != auth()->user()->id)
                    <a  href="{{ route('add.vote', $project->id) }}"  class="m-0.5 sm:m-1  py-2 px-2 border border-yellow-400 text-yellow-600 hover:bg-yellow-400 rounded hover:text-white transition-all duration-200 text-xs sm:text-sm md:text-base flex justify-center w-full sm:w-auto">Vote <span class="pl-1"> {{ $project->votes_sum_votes != null ?  $project->votes_sum_votes : 0 }}</span></a>
                @else
                <p   class="m-0.5 sm:m-1  py-2 px-2 border border-yellow-400 text-yellow-600   rounded  text-xs sm:text-sm md:text-base flex justify-center w-full sm:w-auto">Vote <span class="pl-1"> {{ $project->votes_sum_votes != null ?  $project->votes_sum_votes : 0 }}</span></p>
                @endif
            @else
                <a  href="{{ route('add.vote', $project->id) }}"  class="m-0.5 sm:m-1  py-2 px-2 border border-yellow-400 text-yellow-600 hover:bg-yellow-400 rounded hover:text-white transition-all duration-200 text-xs sm:text-sm md:text-base flex justify-center w-full sm:w-auto">Vote  <span class="pl-1"> {{ $project->votes_sum_votes != null ?  $project->votes_sum_votes : 0 }}</span></a>
            @endif

        </div>
    </td>
</tr>
