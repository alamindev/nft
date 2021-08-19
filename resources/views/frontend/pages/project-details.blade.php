@section('title')
Project details
@endsection
@push('scripts')
<script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
<script>
     $('.countdown').countdown($('.countdown').attr('data-date'), function(event) {
        $(this).html(event.strftime('%w weeks %d days %H:%M:%S'));
    });
</script>
@endpush
<x-app-layout>
    <div class="py-10 px-4 lg:px-16">
        <div class="container mx-auto">
           @include('frontend.includes.ads-image')
        </div>
    </div>
    <section class="bg-white  py-10 px-4 lg:px-16">
        <div class="container mx-auto">
            <h2 class="text-lg font-bold pb-5">Project details</h2>
            <div class="flex justify-between">
                <div class="flex flex-col sm:flex-row items-center">
                    <img class="w-12 md:w-16 h-12 md:h-16 object-cover" src="{{ asset($project->photo) }}"   alt="page-image">
                    <p class="pt-1 sm:pt-0 text-xs font-semibold md:text-base pl-1 sm:pl-3 text-center">{{ $project->name }}</p>
                </div>
                <div>
                    <div class="flex justify-end pb-2">
                        @if($project->website_link != null)
                        <a href="{{ $project->website_link }}" target="_blank"><i class="fas fa-globe-americas p-2 text-indigo-600 text-2xl"></i></a>
                        @endif
                        @if($project->discord_link != null)
                        <a href="{{ $project->discord_link }}" target="_blank" ><i class="fab fa-discord p-2 text-indigo-600 text-2xl"></i></a>
                        @endif
                        @if($project->twitter_link != null)
                        <a  href="{{ $project->twitter_link }}"  target="_blank"    ><i class="fab fa-twitter p-2 text-indigo-600 text-2xl "></i></a>
                        @endif
                    </div>
                    @php
                    $date = \Carbon\Carbon::parse($project->launch_date)->format('d-m-Y');
                    $time = \Carbon\Carbon::parse($project->launch_time)->format('h:i A');
                    $date_time = $date . ' ' . $time;
                    $date_now = new DateTime();
                    $date2    = new DateTime($date_time);
                    $result = '';
                    if($date_now < $date2){
                            $result.='<div class="countdown" data-date="'. \Carbon\Carbon::parse($date_time)->format('Y/m/d h:i A') .'"></div> ';
                        } else{
                            $result.=  $date_time . ' '. $project->timezone;
                        }
                    @endphp
                    <span class="text-xs md:text-sm lg:text-base uppercase flex">Launch Date:  <strong class="pl-2">{!!  $result !!}</strong></span>
                </div>
            </div>
            <div class="flex flex-col-reverse sm:flex-row pt-10 gap-10">
                <div class="sm:w-8/12 lg:w-8/12 xl:w-9/12">
                    <h2 class="text-lg font-bold pb-5">Description</h2>
                    <div>{!! $project->description !!}</div>
                </div>
                <div class="sm:w-4/12 lg:w-4/12 xl:w-3/12">
                    <div class="bg-black p-5">
                        <h2 class="text-white text-lg font-bold pb-5">Vote</h2>
                        <div  class="flex justify-between pt-2 pb-5">
                            <h3 class="text-white text-sm font-semibold">Total Vote</h3>
                            <p class="text-white text-sm font-semibold">{{ $project->custom_vote_sum_vote != null ? $project->custom_vote_sum_vote : 0 }}</p>
                        </div>
                        <div class="flex justify-between pb-5">
                            <h3 class="text-white text-sm font-semibold">Today's Vote</h3>
                            <p class="text-white text-sm font-semibold">{{ $todayVote }}</p>
                        </div>
                        <div class="flex justify-center pt-5">
                            @if(auth()->check())
                                @if($project->user_id != auth()->user()->id)
                                    <a  href="{{ route('add.vote', $project->id) }}"  class="m-0.5 sm:m-1  py-2 px-3 border-2 border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-white transition-all duration-200 text-base font-semibold w-full flex justify-center">Vote Now</a>
                                @endif
                            @else
                                <a  href="{{ route('add.vote', $project->id) }}"  class="m-0.5 sm:m-1  py-2 px-3 border-2 border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-white  transition-all duration-200 text-base font-semibold w-full  flex justify-center">Vote Now</a>
                            @endif
                        </div>
                        <div class="flex justify-center">
                            @if(auth()->check())
                                @if($project->user_id !== auth()->user()->id)
                                @php
                                    $collection = collect($project->favourite);
                                @endphp
                                @if($collection->contains('user_id',auth()->user()->id))
                                <a href="{{ route('add.unfavourite', $project->id) }}" class="m-0.5 sm:m-1  py-2  px-3  font-semibold  border-2 border-white  bg-white text-black hover:text-black transition-all duration-200 text-sm flex justify-center w-full "  >Added Favourite</a>
                                @else
                                <a href="{{ route('add.favourite', $project->id) }}" class="m-0.5 sm:m-1  py-2  px-3 text-white font-semibold  border-2 border-white hover:bg-white hover:text-black transition-all duration-200 text-sm flex justify-center w-full "  >Add Favourite</a>
                                @endif
                                @endif
                            @else
                                <a href="{{ route('add.favourite', $project->id) }}" class="m-0.5 sm:m-1 py-2 px-3 text-white font-semibold  border-2 border-white hover:bg-white hover:text-black transition-all duration-200 text-sm flex justify-center w-full "  >Add favourite</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>


