@section('title')
Reset Password
@endsection

<x-app-two-layout>
    <div class="py-5 h-full flex">
        <div class="w-full max-w-sm m-auto bg-indigo-100 rounded p-5 shadow">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <h2 class="text-lg pb-3 text-center text-indigo-600 font-medium">Add new Password</h2>
              <div class="pb-4">
                <label class="block mb-2 text-indigo-500" for="email">Email</label>
                <input class="input" type="text" name="email" id="email" value="{{ $email }}" required readonly>
              </div>
              <div class="pb-4">
                <label class="block mb-2 text-indigo-500" for="password">Password</label>
                <input class="input" type="password" name="password" id="password" required>
                @error('password')
                    <span class="text-red-800">{{ $message }} </span>
                @enderror
              </div>
              <div class="pb-4">
                <label class="block mb-2 text-indigo-500" for="password">Confirm Password</label>
                <input class="input" type="password" name="password_confirmation" id="password" required>
                @error('password')
                    <span class="text-red-800">{{ $message }} </span>
                @enderror
              </div>
              <div>
                <button class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit"> Reset Password </button>
              </div>
            </form>
          </div>
    </div>
</x-app-two-layout>
