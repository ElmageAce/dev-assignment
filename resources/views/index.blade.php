<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid gap-y-4 grid-cols-1 pb-3">
                <form action="{{ route('index') }}" method="get">
                    <div class="block">
                        <div class="px-4 md:px-0">
                            <div class="grid grid-cols-12 gap-6">
                                <div class="col-span-5 sm:col-span-3 lg:col-start-8 lg:col-span-2">
                                    <label for="sort" hidden>Sort</label>
                                    <select id="sort" name="sort_by"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="" selected disabled>Sort Posts</option>
                                        @foreach($sort_params as $key => $param)
                                        <option value="{{$key}}">{{ $param }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-span-5 sm:col-span-3 lg:col-span-2">
                                    <label for="direction" hidden>Direction</label>
                                    <select id="direction" name="direction"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="" selected disabled>Direction</option>
                                        @foreach($directions as $key => $direction)
                                            <option value="{{$key}}">{{ $direction }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                                    <x-button class="mt-1 text-base text-center w-full">
                                        {{ __('Sort') }}
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="grid gap-x-8 gap-y-4 grid-cols-1 md:grid-cols-2">

                @foreach($posts as $post)
                    <a href="#" class="group block w-full rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-sky-300 hover:ring-sky-300">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-gray-900 group-hover:text-white text-2xl leading-tight capitalize font-medium mb-2">{{ $post->title }}</h3>
                        </div>
                        <p class="text-slate-500 group-hover:text-white text-sm">{{ \Illuminate\Support\Str::words($post->description, 20) }}</p>
                        <p class="text-gray-400 group-hover:text-white text-xs">
                            By <span class="text-gray-400 group-hover:text-white">{{ $post->user->name }}</span> <br>
                            Published <span class="text-gray-400 group-hover:text-white">{{ \Illuminate\Support\Carbon::parse($post->published_date)->toDayDateTimeString() }}</span>
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
