<nav>
    <ul class="flex items-center text-blue-500">
        <li class="ml-2">
            <a href="{{ route('home') }}" class="px-3 py-2 hover:bg-blue-500 hover:text-white">
                Home
            </a>
        </li>

        <li class="ml-2">
            <a href="{{ route('users.show', ['user' => auth()->user()]) }}"
                class="px-3 py-2 hover:bg-blue-500 hover:text-white">
                Profile
            </a>
        </li>

        <li class="ml-2">
            <a href="#" class="px-3 py-2 hover:bg-blue-500 hover:text-white">
                Notifications
            </a>
        </li>

        <li class="ml-2">
            <a href="{{ route('users.friends', ['user' => auth()->user()]) }}"
                class="flex items-center px-3 py-2 hover:bg-blue-500 hover:text-white">
                Friends
                @if (auth()->user()->pendingFriendRequestsCount() > 0)
                    <x-notification-count-bubble :count="auth()->user()->pendingFriendRequestsCount()" />
                @endif
            </a>
        </li>

        <li class="ml-2">
            <a href="{{ route('search') }}" class="px-3 py-2 hover:bg-blue-500 hover:text-white">
                Search
            </a>
        </li>
    </ul>
</nav>
