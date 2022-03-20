<div x-data="{
    show: false,
    avatarUrl: '{{ $user->getAvatarUrl() }}',
    close() {
        this.show = false
    },
}" x-show="show" x-cloak @keyup.escape.window="close" @open-avatar-modal.window="show = true"
    class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div @click.outside="close"
            class="inline-block align-bottom bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="text-center sm:mt-0 sm:text-left">
                    <h3 class="text-xl text-center font-bold leading-5 text-gray-900" id="modal-title">
                        {{ $user->name }}'s avatar
                    </h3>
                    <div class="mt-5 overflow-hidden">
                        <template x-if="show">
                            <img style="max-height: 70vh" x-bind:src="avatarUrl" alt="{{ $user->name }}'s avatar">
                        </template>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="close" type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
