<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid gap-y-4 grid-cols-1 pb-3">
                @include('partials.sort_posts', ['route' => route('index')])
            </div>

            <div class="grid gap-x-8 gap-y-4 grid-cols-1">

                @foreach($posts as $post)
                    <a href="{{ route('posts.show', $post->slug) }}" class="group block w-full rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-sky-300 hover:ring-sky-300">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-gray-900 group-hover:text-white text-2xl leading-tight text-capitalize font-medium mb-2">{{ $post->title }}</h3>
                        </div>
                        <p class="text-slate-500 group-hover:text-white text-sm">{{ \Illuminate\Support\Str::words($post->description, 20) }}</p>
                        <p class="text-gray-400 group-hover:text-white text-sm">
                            Published <span class="text-gray-400 group-hover:text-white">{{ carbon_parse($post->publication_date)->toFormattedDateString() }}</span>
                            <br>
                            By <span class="text-gray-400 group-hover:text-white">{{ $post->user->name }}</span>
                        </p>
                    </a>

                @endforeach
            </div>
        </div>

        <div class="max-w-md mx-auto px-8 py-4">
            {{ $posts->links() }}
        </div>

    </div>
</x-guest-layout>
