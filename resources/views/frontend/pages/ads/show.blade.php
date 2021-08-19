@section('title')
Show ads
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
                        <div class="flex w-full  items-center justify-between border-b pb-2">
                            <p class="text-lg text-gray-800 dark:text-gray-100 font-bold">Show ads</p>
                            <a href="{{ route('ads') }}" class="btn bg-gray-300">Back</a>
                        </div>
                        <table class="table w-full">
                            <tr>
                                <td  class="py-2">Name</td>
                                <td  class="py-2">:</td>
                                <td  class="py-2">{{ $show->name }}</td>
                            </tr>
                            <tr>
                                <td  class="py-2">Link</td>
                                <td  class="py-2">:</td>
                                <td  class="py-2">{{ $show->link }}</td>
                            </tr>
                            <tr>
                                <td  class="py-2">Desktop ads</td>
                                <td  class="py-2">:</td>
                                <td  class="py-2">   <img src="{{ asset( $show->desktop_ads) }}" class="h-16" alt="page-image" class="py-2"></td>
                            </tr>
                            <tr>
                                <td class="py-2">Desktop ads</td>
                                <td class="py-2">:</td>
                                <td class="py-2">   <img src="{{ asset( $show->mobile_ads) }}" class="h-16" alt="page-image" class="py-2"></td>
                            </tr>
                            <tr>
                                <td class="py-2">Status</td>
                                <td class="py-2">:</td>
                                @if($show->status == 0)
                                <td class="py-2"><p class="text-white bg-indigo-600 py-1 px-2 text-xs w-32">Pending</p></td>
                                @else
                                <td class="py-2"><p class="text-white bg-indigo-600 py-1 px-2 text-xs w-32">Approved</p></td>
                                @endif
                            </tr>
                            <tr>
                                <td class="py-2">Created Date</td>
                                <td class="py-2">:</td>
                                <td class="py-2">
                                    {{ \Carbon\Carbon::parse($show->created_at)->format('d-m-Y') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


