<footer class="bg-footer-black py-10 px-4 lg:px-16">
    <div class="container mx-auto">
        <div class="flex justify-center sm:justify-between flex-wrap items-center">
            <p class="text-gray-200 text-base ">@isset($footertext){{  $footertext }}@endisset</p>
            <ul class="flex ">
                @foreach ($footer_menus as $menu)
                <li class="px-2"><a href="{{ route('page.view', $menu->slug) }}" class="text-gray-200 hover:text-gray-400 text-base">{{ $menu->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>
