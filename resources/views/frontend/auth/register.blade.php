@section('title')
Register
@endsection

<x-app-two-layout>
    <div class="py-5  h-full flex px-4">
        <div class="w-full max-w-sm m-auto bg-indigo-100 rounded p-5 shadow">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h2 class="text-lg pb-3 text-center text-indigo-600 font-medium">Create a new account</h2>
              <div class="pb-4">
                <label class="block mb-2 text-indigo-500" for="name">Name</label>
                <input class="input" type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="text-red-800">{{ $message }} </span>
                @enderror
              </div>

              <div class="pb-4">
                <label class="block mb-2 text-indigo-500" for="email">Email</label>
                <input class="input" type="text" name="email" id="email" value="{{ old('email') }}" required >
                @error('email')
                    <span class="text-red-800">{{ $message }} </span>
                @enderror
              </div>

              <div class="pb-4">
                <label class="block mb-2 text-indigo-500" for="password">Password</label>
                <input class="input" type="password" name="password" id="password" required>
                @error('password')
                    <span class="text-red-800">{{ $message }} </span>
                @enderror
              </div>

              <div class="pb-4">
                <label class="block mb-2 text-indigo-500" for="password">{{ __('Confirm Password') }}</label>
                <input class="w-full p-2 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-200" type="password" name="password_confirmation" id="password" required>
              </div>

              <div>
                <button class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit"> Register </button>
              </div>
            </form>
            <footer>
              <p class="text-indigo-700  text-sm float-right">Already have an account? <a href="{{ route('login') }}" class="underline text-red-800">Login</a> </p>
            </footer>
          </div>
    </div>
</x-app-layout>
