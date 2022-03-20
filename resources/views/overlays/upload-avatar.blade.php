<x-modal-wrapper x-data="userUploadAvatarModal()" x-cloak x-show="open" @keyup.escape.window="close"
    @open-upload-avatar-modal.window="open = true">

    <form x-ref="form" method="POST" action="{{ route('users.avatar.update', auth()->user()) }}"
        enctype="multipart/form-data" class="inline-block">
        @csrf
        <x-modal @click.outside="open = false">
            <x-slot name="title">Upload New Avatar</x-slot>

            <x-slot name="body">
                <img id="avatar-preview" class="max-h-96 mx-auto border-4 border-dashed p-2 mb-4" x-bind:src="curImg"
                    alt="Avatar of {{ auth()->user()->name }}">

                <input class="text-sm" type="file" name="avatar" accept=".jpg,.png,.bmp" x-ref="fileInput"
                    @change="previewImg" required>
            </x-slot>

            <x-slot name="footer">
                <button type="submit"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Upload
                </button>
                <button @click="close" type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </x-slot>
        </x-modal>
    </form>
</x-modal-wrapper>

@push('scripts')
    <script>
        function userUploadAvatarModal() {
            return {
                open: false,
                curImg: '{{ auth()->user()->getAvatarUrl() }}',
                init() {
                    // this.$refs.form.reset()
                },
                close() {
                    this.curImg = '{{ auth()->user()->getAvatarUrl() }}'
                    this.open = false
                    this.$refs.fileInput.val = ''
                },
                previewImg() {
                    const selectedFile = this.$refs.fileInput.files[0]

                    if (selectedFile.size >= 5 * 1024 * 1024) {
                        this.$refs.form.reset()
                        alert('File size can\'t be larger than 5mb. Please choose a smaller file.')

                        return
                    }

                    if (selectedFile.size < 25 * 1024) {
                        this.$refs.form.reset()
                        alert('File size can\'t be smaller than 25KB. Please choose a larger file.')

                        return
                    }

                    const reader = new FileReader()
                    reader.onload = () => {
                        this.curImg = reader.result
                    }

                    reader.readAsDataURL(selectedFile);
                }
            };
        }
    </script>
@endpush
