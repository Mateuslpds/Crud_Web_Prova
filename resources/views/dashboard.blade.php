<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>My Movies</h1>
                    @foreach (Auth::user()->myMovies as $movie)
                        <div class="flex justify-between border-b mb-2 gap-4 hover:big-gray-300" x-data="{showDelete: false, showEdit: false}">
                            <div class="flex justify-between flex-grow">
                                <div>{{ $movie->title }}</div>
                                <div>{{ $movie->genre }}</div>
                                <div>{{ $movie->director }}</div>
                                <div>{{ $movie->launch_year }}</div>
                            </div>
                            <div class="flex gap-2">
                                <div>
                                    <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded" @click="showDelete = true">Delete</button>
                                </div>
                                <div>
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded" @click="showEdit = true">Edit</button>
                                </div>
                            </div>

                            <template x-if="showDelete">
                                <div class="absolute top-0 bottom-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                    <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10">
                                        <h2 class="text-xl font-bold text-center">Are you sure?</h2>
                                        <div class="flex justify-between mt-4">
                                            <form action="{{ route('movie.destroy', $movie) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button>Yes</x-danger-button>
                                            </form>
                                            <x-primary-button @click="showDelete = false">No</x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="showEdit">
                                <div class="absolute top-0 bottom-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                    <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10">
                                        <h2 class="text-xl font-bold text-center">{{ $movie->title }}</h2>
                                        <div class="flex justify-between mt-4">
                                            <form action="{{ route('movie.update', $movie) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <x-text-input name='title' placeholder="Title" value="{{ $movie->title }}" />
                                                <x-text-input name='genre' placeholder="Genre" value="{{ $movie->genre }}" />
                                                <x-text-input name='director' placeholder="Director" value="{{ $movie->director }}" />
                                                <x-text-input name='launch_year' placeholder="Launch Year" value="{{ $movie->launch_year }}" />
                                                <x-primary-button>Editar</x-primary-button>
                                            </form>
                                            <x-danger-button @click="showEdit = false">Cancel</x-danger-button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    @endforeach
                    <form action="{{ route('movie.store') }}" method="POST">
                        @csrf
                        <x-text-input name='title' placeholder="Title" />
                        <x-text-input name='genre' placeholder="Genre" />
                        <x-text-input name='director' placeholder="Director" />
                        <x-text-input name='launch_year' placeholder="Launch Year" />
                        <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded">Register Movie</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
