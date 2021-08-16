@section('title')
Profile
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
                        <form id="login" method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="xl:w-full border-b border-gray-300 dark:border-gray-700 py-3 bg-white dark:bg-gray-800">
                                    <div class="flex w-11/12 mx-auto xl:w-full xl:mx-0 items-center">
                                        <p class="text-lg text-gray-800 dark:text-gray-100 font-bold">Profile</p>
                                        <div class="ml-2 cursor-pointer text-gray-600 dark:text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                                <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0v-4a1 1 0 0 1 1-1zm0-4a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" fill="currentColor" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="mx-auto">
                                    <div class="rounded relative mt-4 h-24">
                                        <div class="absolute bg-gray-100 top-0 right-0 bottom-0 left-0 rounded"></div>
                                        <div class="w-20 h-20 rounded-full bg-cover bg-center bg-no-repeat absolute bottom-0 -mb-10 ml-12 shadow flex items-center justify-center">
                                            @if(auth()->user()->photo == null)
                                                <img src="{{ asset('images/avatar.png') }}" alt="" class="profile-pic absolute z-0 h-full w-full object-cover rounded-full shadow top-0 left-0 bottom-0 right-0" />
                                            @else
                                                <img src="{{ asset(auth()->user()->photo) }}" alt="" class="profile-pic absolute z-0 h-full w-full object-cover rounded-full shadow top-0 left-0 bottom-0 right-0" />
                                            @endif
                                        </div>
                                        <div class="z-20 absolute bottom-4 left-12 ">
                                            <label class="cursor-pointer">
                                                <div class="bg-indigo-700 text-white rounded-full p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z" />
                                                        <path d="M16 5l3 3" />
                                                        <path d="M9 7.07a7.002 7.002 0 0 0 1 13.93a7.002 7.002 0 0 0 6.929 -5.999" />
                                                    </svg>
                                                </div>
                                                <input type='file' name="photo" class="hidden file-upload"  />
                                            </label>
                                        </div>
                                    </div>
                                    @if($errors->has('photo'))
                                        <div class="text-red-500 pt-10">{{ $errors->first('photo') }}</div>
                                    @endif
                                    <div class="w-full mx-auto xl:mx-0">
                                        <div class="mt-16 flex flex-col xl:w-4/6 w-full">
                                            <label for="name" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Name</label>
                                            <input type="text" id="name" name="name"  class="input-two" placeholder="Enter your name" required value="{{ auth()->user()->name }}"/>
                                            @if($errors->has('name'))
                                                <div class="text-red-500">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                        <div class="mt-5 flex flex-col xl:w-4/6   w-full">
                                            <label for="email" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Email</label>
                                            <input type="text" id="email" name="email" disabled readonly  value="{{ auth()->user()->email }}" class="input-two" placeholder="example@gmail.com" />
                                        </div>
                                        <div class="mt-5 flex flex-col xl:w-4/6 w-full">
                                            <label for="address" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Address</label>
                                            <textarea type="text" id="address" name="address" class="textarea"> {{ auth()->user()->address }}</textarea>
                                            @if($errors->has('address'))
                                            <div class="text-red-500">{{ $errors->first('address') }}</div>
                                        @endif
                                        </div>
                                        <div class="pt-3">
                                            <button type="submit" class="btn bg-indigo-600 text-white hover:bg-indigo-700">Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


