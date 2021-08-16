@section('title')
Verify email
@endsection

<x-app-layout>
    <div class="pt-28 pb-5 h-full">
        <div class="w-full max-w-lg m-auto bg-white rounded p-5 shadow">
            <h2 class="text-xl pb-3 text-center text-indigo-600 font-bold">Verify Your Email Address</h2>

            @if (session('resent'))
                <div class="py-2 px-3 bg-green-300 text-green-600" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
                <h3 class="text-base pt-3">Before proceeding, please check your email for a verification link.</h3>
                <h3 class="text-base ">If you did not receive the email</h3>
            <form class="pt-5" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div class="flex justify-center"> <button type="submit" class="btn bg-indigo-500 text-white">Send Again</button></div>
            </form>
          </div>
    </div>
</x-app-layout>
