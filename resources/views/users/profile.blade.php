@extends('layouts.master')

@section('sidebar-menu')
    <x-sidebar-menu>
        <x-sidebar-menu-item to="#" fa-class="fa-user" selected>About</x-sidebar-menu-item>
        <x-sidebar-menu-item to="#" fa-class="fa-th-list">Posts</x-sidebar-menu-item>
        @if (auth()->user()->can('update', $user))
            <x-sidebar-menu-item to="#" fa-class="fa-edit">Edit Profile</x-sidebar-menu-item>
            <x-sidebar-menu-item to="#" fa-class="fa-wrench">Change Password</x-sidebar-menu-item>
            <x-sidebar-menu-item to="#" fa-class="fa-trash">Delete Profile</x-sidebar-menu-item>
        @endif
    </x-sidebar-menu>
@endsection

@section('content')
    <div class="flex justify-between">
        <div class="w-3/4 mr-10">
            <h2 class="text-4xl font-bold text-gray-700">{{ $user->name }}</h2>

            <hr class="border-t border-gray-300 my-3">

            <div class="text-gray-600 my-1">
                <span class="font-bold"><a href="{{ $user->url }}">{{ $user->usernamePrefixed }}</a></span>
                @if ($user->tagline)
                    <span> | {{ $user->tagline }}</span>
                @endif
            </div>

            <div class="text-gray-600 my-1">
                <a href="mailto:{{ $user->email }}"><i class="fas fa-envelope mr-1"></i> {{ $user->email }}</a>
            </div>

            <div class="text-gray-600 my-1">
                <span>
                    @php
                        switch ($user->sex) {
                            case 'Male':
                                $faSexIcon = 'fa-male';
                                break;
                            case 'Female':
                                $faSexIcon = 'fa-female';
                                break;
                            default:
                                $faSexIcon = 'fa-genderless';
                                break;
                        }
                    @endphp
                    <i class="fas {{ $faSexIcon }} mr-1"></i>
                    {{ $user->sex }}
                </span>

                @if ($user->birthdate)
                    <span> | <i class="fas fa-birthday-cake mr-1"></i> {{ $user->birthdate->format('d/m/Y') }}</span>
                @endif

                @if ($user->country)
                    <span> | <i class="fas fa-flag mr-1"></i> {{ $user->country }}</span>
                @endif
            </div>

            @if ($user->about)
                <hr class="border-t border-gray-300 my-3">

                <blockquote class="mt-4 text-gray-600 border-l-4 border-gray-300 pl-5 text-lg">
                    {{ $user->about }}
                </blockquote>
            @endif


            @if (auth()->user()->can('update', $user))
                <hr class="border-t border-gray-300 mt-5 mb-3">

                <a href="{{ route('users.edit', ['user' => $user]) }}"
                    class="flex justify-end items-center text-sm text-blue-500">
                    <i class="fa fa-edit mr-1" aria-hidden="true"></i>
                    Edit profile
                </a>
            @endif
        </div>

        <div class="w-1/4">
            <div class="mt-5 p-1 border border-gray-300">
                <img src="/img/user.jpg" alt="" class="mx-auto w-full">
            </div>
            <div>
                @if (auth()->user()->can('update', $user))
                    <button
                        class="block mx-auto mt-2 w-full py-2 border border-gray-300 bg-gray-200 hover:bg-gray-300 text-black">
                        <i class="fa fa-camera mr-1" aria-hidden="true"></i>
                        Upload Photo
                    </button>
                @endif
                <button
                    class="block mx-auto mt-2 w-full py-2 border border-gray-300 bg-gray-200 hover:bg-gray-300 text-black">
                    <i class="fa fa-user mr-1" aria-hidden="true"></i>
                    Add as Friend
                </button>
            </div>
        </div>
    </div>
@endsection
