<form action="{{ $route }}" method="get">
    <div class="block">
        <div class="px-4 md:px-0">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-5 sm:col-span-3 lg:col-start-8 lg:col-span-2">
                    <label for="sort" hidden>Sort</label>
                    <select id="sort" name="sort_by"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" selected disabled>Sort Posts</option>
                        @foreach($sort_params as $key => $param)
                            <option value="{{$key}}" @if( request()->query('sort_by') === $key ) selected @endif>{{ $param }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-5 sm:col-span-3 lg:col-span-2">
                    <label for="direction" hidden>Direction</label>
                    <select id="direction" name="direction"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" selected disabled>Direction</option>
                        @foreach($directions as $key => $direction)
                            <option value="{{$key}}" @if( request()->query('direction') === $key ) selected @endif>{{ $direction }}</option>
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
