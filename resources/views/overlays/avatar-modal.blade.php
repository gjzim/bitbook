<x-modal-wrapper x-data="{
    show: false,
    avatarUrl: '{{ $user->getAvatarUrl() }}',
    close() {
        this.show = false
    },
}" x-show="show" x-cloak @keyup.escape.window="close" @open-avatar-modal.window="show = true">
    <x-modal @click.outside="show = false">
        <x-slot name="body">
            <template x-if="show">
                <img style="max-height: 70vh" x-bind:src="avatarUrl" alt="{{ $user->name }}'s avatar">
            </template>
        </x-slot>

        <x-slot name="footer">
            <button @click="close" type="button"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Close
            </button>
        </x-slot>
    </x-modal>
</x-modal-wrapper>
