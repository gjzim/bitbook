<div x-data="{
    open: false,
    curImg: '{{ auth()->user()->getAvatarUrl() }}',
    close() {
        this.curImg = '{{ auth()->user()->getAvatarUrl() }}'
        this.open = false
        this.$refs.fileInput.val = ''
    },
    previewImg() {
        const selectedFile = this.$refs.fileInput.files[0]

        if( !this.validateImg(selectedFile) ) {
            alert('File size can\'t be larger than 5mb. Please choose a smaller file.')
            this.$refs.form.reset()

            return
        }

        const reader = new FileReader()
        reader.onload = () => {
            this.curImg = reader.result
        }

        reader.readAsDataURL(selectedFile);
    },
    validateImg(file) {
        return file.size < 5 * 1024 * 1024
    }
}" x-show="open" x-init="$refs.form.reset()" @keyup.escape.window="close" @open-avatar-modal.window="open = true"
    class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div @click.outside="close"
            class="inline-block align-bottom bg-white text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form x-ref="form" method="POST" action="{{ route('users.avatar.update', auth()->user()) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="text-center sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-bold leading-5 text-gray-900" id="modal-title">
                            Upload New Avatar
                        </h3>
                        <div class="mt-5 overflow-hidden">
                            <img id="avatar-preview" class="max-h-96 mx-auto border-4 border-dashed p-2 mb-4"
                                x-bind:src="curImg" alt="Avatar of {{ auth()->user()->name }}">

                            <input class="text-sm" type="file" name="avatar" accept=".jpg,.png,.bmp"
                                x-ref="fileInput" @change="previewImg" required>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Upload
                    </button>
                    <button @click="close" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
