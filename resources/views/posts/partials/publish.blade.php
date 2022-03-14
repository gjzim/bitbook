<div class="bg-gray-100 p-5">
    <h3 class="text-2xl leading-none font-bold text-gray-600 mb-4">What's on your mind?</h3>

    <form x-data="{
        error: '',
        handleFormSubmission() {
            if(this.$el.elements.content.value === '' && this.$el.elements.image.value === '') {
                this.error = 'Please select an image or add some text before submitting!'

                return
            }

            this.error = ''
            this.$el.submit()
        }
    }" x-init="$el.reset()" @submit.prevent="handleFormSubmission" class="mt-2"
        action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="my-2">
            <x-label for="content" :value="__('Status:')" class="hidden" />
            <x-textarea name="content" id="content" class="w-full" rows="3"></x-textarea>
        </div>

        <div x-data="{
            curImg: '',
            previewImg(event) {
                const selectedFile = event.target.files[0]

                if( selectedFile.size >= 5 * 1024 * 1024 ) {
                    alert('File size can\'t be larger than 5MB. Please choose a smaller file.')

                    return
                }

                if(selectedFile.size < 25 * 1024) {
                    alert('File size can\'t be smaller than 25KB. Please choose a larger file.')

                    return
                }

                const reader = new FileReader()
                reader.onload = () => {
                    this.curImg = reader.result
                }

                reader.readAsDataURL(selectedFile);
            }
        }" class="flex items-center justify-between">
            <div class="flex items-center">
                <div x-show="curImg"
                    class="group relative flex justify-center items-center w-16 h-16 p-1 mr-2 overflow-hidden bg-white border border-dashed border-gray-400 cursor-pointer">
                    <img id="image-preview" class="max-w-16 max-h-16" x-bind:src="curImg"
                        alt="Image attached to the post">

                    <span @click="curImg = ''"
                        class="flex opacity-0 group-hover:opacity-90 absolute top-0 left-0 w-full h-full justify-center items-center bg-gray-300 text-gray-700">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </span>
                </div>

                <label for="image">
                    <input type="file" name="image" id="image" class="hidden" accept=".jpg,.png,.bmp"
                        @change="previewImg" x-ref="imageInput">

                    <span x-show="curImg == ''"
                        class="bg-gray-500 text-center text-white px-4 py-1 hover:bg-gray-600 cursor-pointer">Add
                        Image</span>
                </label>
            </div>

            <button type="submit" class="bg-blue-600 text-center text-white px-4 py-1 mr-2 hover:bg-blue-500">
                Publish
            </button>
        </div>

        @error('image')
            <span class="my-1 text-sm text-red-500" role="alert">
                <strong>**{{ $message }}</strong>
            </span>
        @enderror

        <div x-show="error !== ''" x-text="'**' + error" class="my-1 text-sm font-bold text-red-500"></div>
    </form>
</div>
