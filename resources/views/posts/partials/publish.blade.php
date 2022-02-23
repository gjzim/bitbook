<div class="bg-gray-100 p-5">
    <h3 class="text-2xl leading-none font-bold text-gray-600 mb-4">What's on your mind?</h3>

    <form x-init="$el.reset()" class="mt-2" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="my-2">
            <x-label for="content" :value="__('Status:')" class="hidden" />
            <x-textarea name="content" id="content" class="w-full" rows="3" required></x-textarea>
            <x-form-error field="content" />
        </div>

        <div x-data="{
            curImg: '',
            previewImg(event) {
                const reader = new FileReader()
                reader.onload = () => this.curImg = reader.result
                reader.readAsDataURL(event.target.files[0]);
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
    </form>
</div>
