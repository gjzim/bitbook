<div x-data="{
    status: '{{ $friendshipStatus }}',
    createFriendship() {
        if(this.status !== 'none') {
            return
        }

        const url = '{{ route('users.friendships.create', ['receiver' => $user]) }}'
        axios.post(url)
        .then(response => {
            this.status = 'request_sent'
        })
        .catch(err => console.log('Something has gone wrong!'))
    },
    acceptFriendship() {
        if(this.status === 'none') {
            return
        }

        const url = '{{ route('users.friendships.update', [
            'sender' => $user,
            'receiver' => auth()->user(),
        ]) }}'

        axios.put(url, { action: 'accept-friendship' })
        .then(response => {
            this.status = 'friends'
        })
        .catch(err => console.log('Something has gone wrong!'))
    },
    removeFriendship() {
        if(this.status === 'none') {
            return
        }

        const url = '{{ route('users.friendships.destroy', [
            'sender' => auth()->user(),
            'receiver' => $user,
        ]) }}'

        axios.delete(url)
        .then(response => {
            this.status = 'none'
        })
        .catch(err => console.log('Something has gone wrong!'))
    }
}">
    <button x-show="status == 'none'" @click="createFriendship"
        class="block mx-auto mt-2 w-full py-2 border bg-blue-500 hover:bg-blue-600 text-white">
        <i class="fa fa-user-plus mr-1" aria-hidden="true"></i>
        Add Friend
    </button>

    <button x-show="status == 'request_sent'" @click="removeFriendship"
        class="block mx-auto mt-2 w-full py-2 border bg-blue-500 hover:bg-blue-600 text-white">
        <i class="fa fa-user-times mr-1" aria-hidden="true"></i>
        Cancel Request
    </button>

    <div x-data="{
        showDropdown: false
    }" x-show="status == 'request_recieved'" @click.outside="showDropdown = false" class="relative">
        <button @click="showDropdown = !showDropdown"
            class="block mx-auto mt-2 w-full py-2 border bg-blue-500 hover:bg-blue-600 text-white">
            <i class="fa fa-user-check mr-1" aria-hidden="true"></i>
            Respond
        </button>
        <div x-show="showDropdown"
            class="origin-top-right absolute right-0 w-full mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">

            <div class="py-1 text-center" role="none">
                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-200" role="menuitem" tabindex="-1"
                    id="menu-item-0" @click='acceptFriendship'>Confirm</a>
                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-200" role="menuitem"
                    tabindex="-1" id="menu-item-1" @click='removeFriendship'>Delete Request</a>
            </div>
        </div>
    </div>

    <div x-data="{
        showDropdown: false
    }" x-show="status == 'friends'" @click.outside="showDropdown = false" class="relative">
        <button @click="showDropdown = !showDropdown"
            class="block mx-auto mt-2 w-full py-2 border bg-gray-200 hover:bg-gray-300 text-gray-800">
            <i class="fa fa-user-check mr-1" aria-hidden="true"></i>
            Friends
        </button>
        <div x-show="showDropdown"
            class="origin-top-right absolute right-0 w-full mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">

            <div class="py-1 text-center" role="none">
                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-200" role="menuitem"
                    tabindex="-1" id="menu-item-1" @click='removeFriendship'>Unfriend</a>
            </div>
        </div>
    </div>
</div>
