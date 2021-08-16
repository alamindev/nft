@section('title')
 {{ $page->title }}
@endsection

<x-app-layout>
    <section class="relative dynamic--pages"><div class="w-full py-24 px-4 lg:px-16 bg-no-repeat bg-cover" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.5)), url({{ asset('storage'. $page->thumb) }});"><div class="container mx-auto"><div class="w-full"><h1 class="text-center text-white text-xl sm:text-2xl md:text-3xl leading-relaxed pb-5 font-semibold">
        {{ $page->title }}
      </h1></div></div></div></section>
    <section class="px-4 lg:px-16">
        <div class="container mx-auto"> <div class="py-10 text-lg">
            {!! $page->content !!}
 </div></div></section>
</x-app-layout>


