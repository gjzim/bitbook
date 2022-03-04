<div x-data="{
    open: false,
    show() {
        this.open = true
    },
    hide() {
        this.open = false
    },
}" x-show="open" @open-notification-box.window="show" @click.outside="hide" @keyup.escape.window="hide"
    class="absolute top-20 right-0 bg-white border shadow-lg" style="width: 550px;">
    <div class="overflow-y-auto p-2" style="max-height: 600px;">
        @include('notifications.list')
    </div>

    <a href="{{ route('notifications.index') }}"
        class="block w-full -mt-2 p-2 text-center bg-gray-100 text-sm text-gray-600">View
        all notifications</a>
</div>
