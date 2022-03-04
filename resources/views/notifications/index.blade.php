@extends('layouts.notifications')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-700">All notifications</h1>

        <form action="{{ route('users.unread-notifications.check', ['user' => auth()->user()]) }}" method="POST">
            @csrf @method('PUT')

            <button type="submit"
                class="flex items-center relative top-1 px-3 py-1 font-medium text-sm text-center text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300">
                <i class="fa fa-eye mr-2" aria-hidden="true"></i>
                Mark all as read
            </button>
        </form>
    </div>

    <hr class="border-t border-gray-300 my-4">

    @include('notifications.list', ['showLoadMoreButton' => true])
@endsection
