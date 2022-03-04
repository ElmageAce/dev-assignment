<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-capitalize leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>


    <div class="container w-full md:max-w-5xl mx-auto py-8">

        <div class="w-full px-4 md:px-6 text-xl text-gray-800 leading-normal" style="font-family:Georgia,serif;">

            <!--Title-->
            <div class="font-sans">
                <p class="text-base md:text-sm text-sky-500 font-bold">
                    &lt; <a href="{{ route('index') }}" class="text-base md:text-sm text-sky-500 font-bold no-underline hover:underline">BACK TO BLOG</a>
                </p>

                <h1 class="font-bold font-sans break-normal text-gray-900 text-capitalize pt-6 pb-2 text-3xl md:text-4xl">{{ $post->title }}</h1>
                <p class="text-sm md:text-base font-normal text-gray-600">Published {{ carbon_parse($post->publication_date)->toFormattedDateString() }}</p>
            </div>

            <!--Lead Para-->
            <p class="py-6">{{ $post->description }}</p>

        </div>

        <!--Divider-->
        <hr class="border-b-2 border-gray-400 mb-8 mx-4">

        <!--Author-->
        <div class="flex w-full items-center font-sans px-4 py-12">
            <div class="flex-1 px-2">
                <p class="text-base font-bold text-base md:text-xl leading-none mb-2">{{ $post->user->name }}</p>
                <p class="text-gray-600 text-xs md:text-base">{{ $post->user->email }}</p>
            </div>
            <div class="justify-end">
                <a href="{{ route('index') }}" class="bg-transparent border border-gray-500 hover:border-sky-500 text-xs text-gray-500 hover:text-sky-500 font-bold py-2 px-4 rounded-full">Read More</a>
            </div>
        </div>
        <!--/Author-->

        <!--Divider-->
        <hr class="border-b-2 border-gray-400 mb-8 mx-4">

    </div>
    <!--/container-->

</x-guest-layout>
