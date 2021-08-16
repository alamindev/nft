<div class="flex flex-col items-center">
    <h2 class="pb-3 text-xs text-yellow-500">Advertise with us!</h2>
    <div class="md:w-10/12 xl:w-9/12">
        @forelse($ads as $ad)
        <a href="{{ $ad->link }}" class="block mb-2" target="_blank">
            <img class="sm:hidden w-full" src="{{ $ad->mobile_ads }}" alt="{{ $ad->name }}">
            <img class="hidden sm:block w-full" src="{{ $ad->desktop_ads }}" alt="{{ $ad->name }}">
        </a>
        @empty
            <h3 class="text-center">No ads found!</h3>
        @endforelse
    </div>
</div>
