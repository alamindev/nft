<tr>
    <td>
        <div class="flex flex-col sm:flex-row items-center">
            <img class="w-12 md:w-16 h-12 md:h-16 object-cover" src="{{ asset($favourite->project->photo) }}"   alt="page-image">
            <p class="pt-1 sm:pt-0 text-xs font-semibold md:text-base pl-1 sm:pl-3 text-center">{{ $favourite->project->name }}</p>
        </div>
    </td>

    <td>
        @php
            $date = \Carbon\Carbon::parse($favourite->project->launch_date)->format('d-m-Y');
            $time = \Carbon\Carbon::parse($favourite->project->launch_time)->format('h:i A');
        @endphp
        <span class="text-xs md:text-sm lg:text-base">{{ $date . ' ' . $time }}</span>
    </td>
    <td class="hidden lg:block ">
        <div class="flex items-center pt-3">
            @if($favourite->project->website_link != null)
            <a href="{{ $favourite->project->website_link }}" target="_blank"><i class="fas fa-globe-americas p-1 text-indigo-600 text-2xl"></i></a>
            @endif
            @if($favourite->project->opensea_link != null)
            <a href="{{ $favourite->project->opensea_link }}" target="_blank"><img class="w-8 h-8 p-1" src="{{ asset('images/opensea.svg') }}" alt=""/></a>
            @endif
            @if($favourite->project->discord_link != null)
            <a href="{{ $favourite->project->discord_link }}" target="_blank" ><i class="fab fa-discord p-1 text-indigo-600 text-2xl"></i></a>
            @endif
            @if($favourite->project->twitter_link != null)
            <a  href="{{ $favourite->project->twitter_link }}"  target="_blank"    ><i class="fab fa-twitter p-1 text-indigo-600 text-2xl "></i></a>
            @endif
        </div>
    </td>
    <td>
        <a  href="{{ route('details',  $favourite->project->slug) }}" class="m-0.5 sm:m-1  py-2 px-3  border border-indigo-600 hover:bg-indigo-600 hover:text-white rounded transition-all duration-200 text-xs sm:text-sm md:text-base flex justify-center w-full sm:w-auto"  >Details</a>
    </td>
</tr>
