@extends('layouts.app')

@section('sidebar-menu')
    <ul>
        <li>
            <a href="/profile" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                <i class="fa fa-th-list mr-1" aria-hidden="true"></i>
                Posts
            </a>
        </li>
        <li>
            <a href="/profile" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                <i class="fa fa-user mr-1" aria-hidden="true"></i>
                About Profile
            </a>
        </li>
        <li>
            <a href="/profile/edit" class="block px-5 py-1 bg-blue-500 text-white pointer-events-none">
                <i class="fa fa-edit mr-1" aria-hidden="true"></i>
                Edit Profile
            </a>
        </li>
        <li>
            <a href="/profile/change-password" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                <i class="fa fa-wrench mr-1" aria-hidden="true"></i>
                Change Password
            </a>
        </li>
        <li>
            <a href="/profile/delete" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                <i class="fa fa-trash mr-1" aria-hidden="true"></i>
                Delete Profile
            </a>
        </li>
    </ul>
@endsection

@section('content')
    @include("users.{$type}")
@endsection
