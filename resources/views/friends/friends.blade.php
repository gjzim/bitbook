@extends('layouts.app')

@section('sidebar-menu')
    <ul>
        <li>
            <a href="#" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                <i class="fa fa-th mr-1" aria-hidden="true"></i>
                Friends List
            </a>
        </li>
        <li>
            <a href="#" class="block px-5 py-1 bg-blue-500 text-white pointer-events-none">
                <i class="fa fa-plus mr-1" aria-hidden="true"></i>
                Friend Requests
            </a>
        </li>
        <li>
            <a href="#" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                <i class="fa fa-question-circle mr-1" aria-hidden="true"></i>
                People You May Know
            </a>
        </li>
    </ul>
@endsection

@section('content')
    @include("friends.{$type}")
@endsection
