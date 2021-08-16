@section('title')
Login
@endsection

<x-app-two-layout>
    <div class="py-5 h-full flex px-4">
        <div class="w-full max-w-sm m-auto bg-indigo-100 rounded p-5 shadow">
            <header>
              <img class="h-10 mx-auto " src="{{ asset('storage'. $logoLink) }}" />
            </header>
            <form method="POST" action="{{ route('login') }}" class="pt-2">
                @csrf
            <h2 class="text-lg pb-3 text-center text-indigo-600 font-medium">Welcome back!</h2>
              <div class="pb-4">
                <label class="block mb-2 text-indigo-500" for="email">Email</label>
                <input class="input" type="text" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="text-red-800">{{ $message }} </span>
                @enderror
              </div>
              <div class="pb-2">
                <label class="block mb-2 text-indigo-500" for="password">Password</label>
                <input class="input" type="password" name="password" id="password" required>
                @error('password')
                    <span class="text-red-800">{{ $message }} </span>
                @enderror
              </div>
              <div class="pb-4">
                <label>
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="text-indigo-500">
                        {{ __('Remember Me') }}
                </label>
            </div>
              <div>
                <button class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit"> Login </button>
              </div>
            </form>
            <footer>
              <a class="text-indigo-700 hover:text-pink-700 text-sm float-left" href="{{ route('password.request') }}">Forgot Password?</a>
              <a class="text-indigo-700 hover:text-pink-700 text-sm float-right" href="{{ route('register') }}">Create an account</a>
            </footer>
          </div>
    </div>
</x-app-two-layout>
