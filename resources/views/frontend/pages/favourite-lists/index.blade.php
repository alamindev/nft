@section('title')
Favorites
@endsection
<x-app-layout>
    <div class="sm:py-10  lg:px-16">
        <div class="container mx-auto">
            <div class="flex flex-col sm:flex-row">
                <div class="sm:w-2/6 pb-2 sm:pb-0  sm:pr-2 md:pr-5" >
                    @include('frontend.includes.sidebar')
                </div>
                <div class="sm:w-4/6   sm:pl-2 md:pl-5">
                    <div class="bg-white p-5">
                        <div class="flex w-full items-center justify-between border-b pb-2">
                            <p class="text-lg text-gray-800 dark:text-gray-100 font-bold">Favorites Lists</p>
                        </div>
                        <div class="py-5">
                            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="1" class="py-2">Name</th>
                                        <th data-priority="4" class="py-2">Launch date</th>
                                        <th data-priority="3" class="hidden lg:flex py-2">Links</th>
                                        <th data-priority="5" class="py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse($favourite_projects as $favourite)
                                        @include('frontend.includes.favourite-table')
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No data found!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $favourite_projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


