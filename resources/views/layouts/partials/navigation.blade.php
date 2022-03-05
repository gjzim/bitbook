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
            <a x-data @click.prevent="$dispatch('open-notification-box')"
                class="flex items-center px-3 py-2 cursor-pointer hover:bg-blue-500 hover:text-white">
                Notifications
                @if (auth()->user()->unreadNotifications->count() > 0)
                    <x-notification-count-bubble @notification-checked.window="count -= 1"
                        :count="auth()->user()->unreadNotifications->count()" />
                @endif
            </a>
        </li>

        <li class="ml-2">
            @if (auth()->user()->pendingFriendRequestsCount() > 0)
                <a href="{{ route('users.friends.pending', ['user' => auth()->user()]) }}"
                    class="flex items-center px-3 py-2 hover:bg-blue-500 hover:text-white">
                    Friends
                    <x-notification-count-bubble @friend-request-accepted.window="count -= 1"
                        :count="auth()->user()->pendingFriendRequestsCount()" />
                </a>
            @else
                <a href="{{ route('users.friends', ['user' => auth()->user()]) }}"
                    class="flex items-center px-3 py-2 hover:bg-blue-500 hover:text-white">
                    Friends
                </a>
            @endif
        </li>

        <li class="ml-2">
            <a href="{{ route('search') }}" class="px-3 py-2 hover:bg-blue-500 hover:text-white">
                Search
            </a>
        </li>
    </ul>
</nav>
