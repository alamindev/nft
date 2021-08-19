@section('title')
Newly Listed
@endsection

<x-app-layout>
    <div class="py-10 px-4 lg:px-16">
        <div class="container mx-auto">
           @include('frontend.includes.ads-image')
            <div class="py-10 xl:px-20">
                <div class="flex items-center mb-3 ">
                    <h2 class="text-lg font-bold ">Newly Listed</h2>
                    <div class="pl-5">
                        <input type="text" autocomplete="off" data-remote="{{ route('search') }}" placeholder="Search..."  id="search" class="py-1 px-4 rounded border border-gray-200">
                        <div class="result relative"></div>
                    </div>
                </div>
                <table class="w-full ranking--table custom--table pb-3">
                    <thead>
                        <tr>
                            <th class="text-sm sm:text-base w-16">Rank</th>
                            <th class="text-sm sm:text-base">Name</th>
                            <th class="text-sm sm:text-base">Launch Date</th>
                            <th class="hidden md:flex items-center text-sm sm:text-base">Links</th>
                            <th class="text-sm sm:text-base sm:w-64 md:w-72" >Votes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            @include('frontend.includes.project-table')
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Data not found!</td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>
                {{ $projects->links() }}
            </div>
        </div>
    </div>

</x-app-layout>


