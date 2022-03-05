<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>


    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title" value="{{ old('title') }}"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('title')
                            <p class="mt-2 text-pink-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <textarea class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                          id="description" name="description" rows="8" placeholder="Post Content">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                            <p class="mt-2 text-pink-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-3">
                            <div>
                                <label for="publication_date" class="block text-sm font-medium text-gray-700">Publish Date</label>
                                <input type="datetime-local" name="publication_date" id="publication_date"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            @error('description')
                            <p class="mt-2 text-pink-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
                        <x-button class="mt-1 text-base text-center">
                            {{ __('Save') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
