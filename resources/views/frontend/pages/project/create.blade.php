@section('title')
Create project
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/timepicker/jquery.timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/datepicker/datepicker.min.css') }}">
@endpush
@push('scripts')
<script type="text/javascript" src="{{ asset('vendor/datepicker/datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/timepicker/jquery.timepicker.min.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.1.0/classic/ckeditor.js"></script>
<script>
    setTimeout(function(){
        $(document).ready(function() {
            var date = Date.now();
            $('#launch_date').datepicker({ format: "yy-mm-dd", startDate: date  });
            $('#launch_time').timepicker({ 'timeFormat': 'H:i' });
        });
        ClassicEditor.create( document.querySelector( '#editor' ) )
    }, 100);
</script>
@endpush
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
                            <p class="text-lg text-gray-800 dark:text-gray-100 font-bold">Create project</p>
                            <a href="{{ route('projects') }}" class="btn bg-gray-300">Back</a>
                        </div>
                        <form  method="post" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="py-5">
                                <div class="mt-5 flex flex-col w-full">
                                    <label for="name" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Name</label>
                                    <input type="text" id="name" name="name"  class="input-two"   required value="{{ old('name') }}"/>
                                    @if($errors->has('name'))
                                        <div class="text-red-500">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="mt-4 flex flex-col w-full">
                                    <label for="photo" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Photo</label>
                                    <input type="file" id="photo" name="photo"  class="input-two"     />
                                    @if($errors->has('photo'))
                                        <div class="text-red-500">{{ $errors->first('photo') }}</div>
                                    @endif
                                </div>
                                <div class="mt-4 flex flex-col w-full">
                                    <label for="website_link" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Website link</label>
                                    <input type="text" id="website_link" name="website_link"  class="input-two"  value="{{ old('website_link') }}"   />
                                    @if($errors->has('website_link'))
                                        <div class="text-red-500">{{ $errors->first('website_link') }}</div>
                                    @endif
                                </div>
                                <div class="mt-4 flex flex-col w-full">
                                    <label for="discord_link" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Discord link</label>
                                    <input type="text" id="discord_link" name="discord_link"  class="input-two" value="{{ old('discord_link') }}"    />
                                    @if($errors->has('discord_link'))
                                        <div class="text-red-500">{{ $errors->first('discord_link') }}</div>
                                    @endif
                                </div>
                                <div class="mt-4 flex flex-col w-full">
                                    <label for="twitter_link" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Twitter link</label>
                                    <input type="text" id="twitter_link" name="twitter_link"  class="input-two"  value="{{ old('twitter_link') }}"   />
                                    @if($errors->has('twitter_link'))
                                        <div class="text-red-500">{{ $errors->first('twitter_link') }}</div>
                                    @endif
                                </div>
                                <div class="flex flex-col md:flex-row">
                                    <div class="mt-4 flex flex-col w-full">
                                        <label for="launch_date" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Launch Date</label>
                                        <input type="text" id="launch_date" name="launch_date"  class="input-two"    value="{{ old('launch_date') }}" />
                                        @if($errors->has('launch_date'))
                                            <div class="text-red-500">{{ $errors->first('launch_date') }}</div>
                                        @endif
                                    </div>
                                    <div class="mt-4 flex flex-col w-full md:pl-5">
                                        <label for="launch_time" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Launch Time</label>
                                        <input type="text" id="launch_time" name="launch_time"  class="input-two"  value="{{ old('launch_time') }}"   />
                                        @if($errors->has('launch_time'))
                                            <div class="text-red-500">{{ $errors->first('launch_time') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4 flex flex-col w-full ">
                                    <label for="launch_time" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Description</label>
                                    <textarea name="description" id="editor" cols="5" rows="5"> </textarea>
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


