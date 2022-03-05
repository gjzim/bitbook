@extends('layouts.friends')

@section('content')
    <div>
        <h1 class="text-4xl font-bold text-gray-700">Friend Requests</h1>

        <hr class="border-t border-gray-300 mt-3 mb-6">

        <div class="my-3">
            <div class="flex flex-wrap">
                @foreach ($user->pendingFriendRequestsFrom as $pendingFriend)
                    <div x-data="{
                            status: 'pending',
                            acceptFriendship() {
                                if(this.status !== 'pending') {
                                    return
                                }

                                const url = '{{ route('users.friendships.update', [
                                    'sender' => $pendingFriend,
                                    'receiver' => $user,
                                ]) }}'

                                axios.put(url, { action: 'accept-friendship' })
                                .then(response => {
                                    this.status = 'friends'
                                    $dispatch('friend-request-accepted')
                                })
                                .catch(err => console.log('Something has gone wrong!'))
                            },
                            removeFriendship() {
                                if(this.status !== 'friends' || ! confirm('Do you really want to unfriend this user?') ) {
                                    return
                                }

                                const url = '{{ route('users.friendships.destroy', [
                                    'sender' => $pendingFriend,
                                    'receiver' => $user,
                                ]) }}'

                                axios.delete(url)
                                .then(response => {
                                    this.$refs.parent.remove()
                                })
                                .catch(err => console.log('Something has gone wrong!'))
                            }
                        }" x-ref="parent" class="w-64 mb-5 mr-5 p-1 border text-center">
                        <a href="{{ $pendingFriend->url }}">
                            <img src="{{ $pendingFriend->getAvatarUrl('thumb') }}"
                                alt="{{ $pendingFriend->name }} avatar image">
                            <div class="p-3 pb-0">
                                <h2 class="font-bold text-blue-500">{{ $pendingFriend->name }}</h2>
                                <h3 class="font-bold text-sm text-gray-600">{{ $pendingFriend->usernamePrefixed }}</h3>
                            </div>
                        </a>
                        <button
                            x-show="status === 'pending'"
                            @click="acceptFriendship"
                            class="inline-flex items-center my-2 px-3 py-1 border border-transparent text-sm text-white bg-blue-600 hover:bg-blue-500 active:bg-blue-900 focus:border-blue-900 focus:ring-blue-200 focus:ring focus:ring-opacity-50 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fa fa-user-check mr-2" aria-hidden="true"></i> Confirm
                        </button>
                        <button
                            x-show="status === 'friends'"
                            @click="removeFriendship"
                            class="inline-flex items-center my-2 px-3 py-1 border border-transparent text-sm text-white bg-red-600 hover:bg-red-500 active:bg-red-900 focus:border-red-900 focus:ring-red-200 focus:ring focus:ring-opacity-50 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fa fa-user-times mr-2" aria-hidden="true"></i> Unfriend
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
