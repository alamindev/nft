@section('title')
Create Ads
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
                            <p class="text-lg text-gray-800 dark:text-gray-100 font-bold">Create ads</p>
                            <a href="{{ route('ads') }}" class="btn bg-gray-300">Back</a>
                        </div>
                        <form  method="post" action="{{ route('ads.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="py-5">
                                <div class="mt-5 flex flex-col w-full">
                                    <label for="name" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Name</label>
                                    <input type="text" id="name" name="name"  class="input-two"   required value="{{ $ad->name }}"/>
                                    @if($errors->has('name'))
                                        <div class="text-red-500">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="mt-5 flex flex-col w-full">
                                    <label for="link" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Link</label>
                                    <input type="text" id="link" name="link"  class="input-two"   required value="{{ $ad->link }}"/>
                                    @if($errors->has('link'))
                                        <div class="text-red-500">{{ $errors->first('link') }}</div>
                                    @endif
                                </div>
                                <div class="mt-4 flex flex-col w-full">
                                    <label for="desktop_ads" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Ads Desktop</label>
                                    <p class="text-sm text-red-500">Image dimensions must be 720 X 90</p>
                                    <input type="file" id="desktop_ads" name="desktop_ads"  class="input-two"     />
                                    <img src="{{ asset( $ad->desktop_ads) }}" class="mt-2 h-12 w-64" alt="page-image" >
                                    @if($errors->has('desktop_ads'))
                                        <div class="text-red-500">{{ $errors->first('desktop_ads') }}</div>
                                    @endif
                                </div>
                                <div class="mt-4 flex  align-center flex-col  ">
                                    <label for="mobile_ads" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Ads Mobile</label>
                                    <p class="text-sm text-red-500">Image dimensions must be 320 X 120</p>
                                    <input type="file" id="mobile_ads" name="mobile_ads"  class="input-two"     />
                                    <img src="{{ asset( $ad->mobile_ads) }}" class="mt-2 h-16 w-32" alt="page-image" >
                                    @if($errors->has('mobile_ads'))
                                        <div class="text-red-500">{{ $errors->first('mobile_ads') }}</div>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn bg-indigo-600 text-white hover:bg-indigo-700">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


