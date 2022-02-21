@extends('layouts.friends')

@section('content')
    <div>
        <h1 class="text-4xl font-bold text-gray-700">People You May Know</h1>

        <hr class="border-t border-gray-300 mt-3 mb-6">

        <div class="my-3">
            <div class="flex flex-wrap">
                @foreach ($user->getSuggestedFriends() as $friend)
                    <div x-data="{
                        status: '{{$user->getFriendshipStatusWith($friend)}}',
                        createFriendship() {
                            const url = '{{ route('users.friendships.create', ['receiver' => $friend]) }}'
                            axios.post(url)
                            .then(response => {
                                this.status = 'request_sent'
                            })
                            .catch(err => console.log('Something has gone wrong!'))
                        },
                        removeFriendship() {
                            if(this.status !== 'request_sent' || ! confirm('Do you really want to cancel sent request?') ) {
                                return
                            }

                            const url = '{{ route('users.friendships.destroy', [
                                'sender' => $user,
                                'receiver' => $friend,
                            ]) }}'

                            axios.delete(url)
                            .then(response => {
                                this.status = 'none'
                            })
                            .catch(err => console.log('Something has gone wrong!'))
                        }
                    }" x-ref="parent" class="w-64 mb-5 mr-5 p-1 border text-center">
                        <a href="{{ $friend->url }}">
                            <div class="flex justify-center items-center overflow-hidden bg-gray-100" style="height: 245px">
                                <img src="{{ $friend->getAvatarUrl('thumb') }}" alt="{{ $friend->name }} avatar image">
                            </div>
                            <div class="p-3 pb-0">
                                <h2 class="font-bold text-blue-500">{{ $friend->name }}</h2>
                                <h3 class="font-bold text-sm text-gray-600">{{ $friend->usernamePrefixed }}</h3>
                            </div>
                        </a>
                        <button
                            x-show="status === 'none'"
                            @click="createFriendship"
                            class="inline-flex items-center my-2 px-3 py-1 border border-transparent text-sm text-white bg-blue-600 hover:bg-blue-500 active:bg-blue-900 focus:border-blue-900 focus:ring-blue-200 focus:ring focus:ring focus:ring-opacity-50 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fa fa-user-plus mr-2" aria-hidden="true"></i> Add Friend
                        </button>

                        <button
                            x-show="status === 'request_sent'"
                            @click="removeFriendship"
                            class="inline-flex items-center my-2 px-3 py-1 border border-transparent text-sm text-white bg-red-600 hover:bg-red-500 active:bg-red-900 focus:border-red-900 focus:ring-red-200 focus:ring focus:ring-opacity-50 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fa fa-user-times mr-2" aria-hidden="true"></i> Cancel Request
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
