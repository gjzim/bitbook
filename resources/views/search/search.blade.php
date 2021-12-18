@extends('layouts.app')

@section('sidebar-menu')
    <ul>
        <li>
            <a href="/search" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                <i class="fa fa-search mr-1" aria-hidden="true"></i>
                Search Result
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <form action="#" class="flex justify-between">
        <div class="flex-grow mr-3">
            <label for="query" class="hidden" aria-hidden="true">Query:</label>

            <div class="">
                <input id="query" type="text" class="w-full border px-2 py-1 @error('query') is-invalid @enderror"
                       name="query"
                       value="{{ old('query') }}" placeholder="Search for profiles" required autocomplete="query">

                @error('query')
                <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="">
            <button type="submit" class="bg-blue-600 text-center text-white px-3 py-1 hover:bg-blue-500">
                Search
            </button>
        </div>
    </form>

    <div class="mt-5 flex flex-wrap justify-between box-border">
        @for ($i = 0; $i < 6; $i++)
            <div class="flex w-auto items-center border border-gray-200 p-3 mb-5" style="width: 49%">
                <div class="mr-5">
                    <img src="/img/user.jpg" alt="" width="100">
                </div>
                <div class="">
                    <h3 class="text-2xl text-blue-500 leading-4 font-bold">Arifur Rehman Khan</h3>
                    <div class="mt-2">
                        <span class="font-bold text-gray-500"><a href="#">@arif26</a></span>
                        <span class="text-gray-500"> &middot; Passonate about programming</span>
                    </div>
                    <div>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white mt-1 px-4 py-1 text-sm">Accept</button>
                        <button class="bg-red-600 hover:bg-red-700 text-white mt-1 px-4 py-1 text-sm">Cancel</button>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
