@extends('layouts.search')

@section('content')
    <form action="{{ route('search') }}" method="GET" class="flex justify-between">
        <div class="flex w-full mr-3">
            <label for="query" class="hidden" aria-hidden="true">Query:</label>

            <div class="w-full">
                <input id="query" type="text" name="query"
                    class="w-full border px-2 py-1 shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50' @error('query') is-invalid @enderror"
                    value="{{ old('query', request('query', '')) }}" placeholder="Search for profiles" required>

                @error('query')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-center text-white px-5 py-1 hover:bg-blue-500">
            Search
        </button>
    </form>

    <div class="flex flex-wrap justify-between mt-5 box-border">
        @forelse ($users as $user)
            <div class="border border-gray-200 p-3 mb-5" style="width: 49%">
                <a class="flex items-center" href="{{ $user->url }}">
                    <img class="mr-5" src="{{ $user->getAvatarUrl('thumb') }}" alt="" width="120px">

                    <div class="">
                        <h3 class="text-2xl text-blue-500 font-bold">{{ $user->name }}</h3>
                        <div class="mt-2">
                            <span class="font-bold text-gray-500">
                                {{ $user->usernamePrefixed }}
                            </span>
                            @if ($user->tagline)
                                <span class="text-gray-500"> &middot; {{ $user->tagline }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @empty
            @if ($searchQuery)
                <div class="w-full bg-yellow-100 text-center py-4 mb-10">Sorry, no results found for:
                    <strong>{{ $searchQuery }}</strong>. Please
                    change the query.</div>
            @endif
        @endforelse
    </div>
@endsection
