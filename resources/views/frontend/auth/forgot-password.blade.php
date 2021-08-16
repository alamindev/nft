@section('title')
Send Password Reset Link
@endsection

<x-app-two-layout>
    <div class="py-5 h-full flex">
        <div class="w-full max-w-sm m-auto bg-indigo-100 rounded p-5 shadow">

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <h2 class="text-lg pb-3 text-center text-indigo-600 font-medium">Reset you Password!</h2>

                @if (session('status'))
                    <div class="py-2 px-3 bg-green-300 text-green-600" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
              <div class="pb-5 pt-3">
                <label class="block mb-2 text-indigo-500" for="email">Email</label>
                <input class="input" type="text" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="text-red-800">{{ $message }} </span>
                @enderror
              </div>

              <div>
                <button class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit"> Send Password Reset Link </button>
                <a class="w-full underline text-indigo-700" href="{{ route('login') }}" >Login</a>
              </div>
            </form>
          </div>
    </div>
</x-app-layout>
