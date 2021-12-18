<div class="">
    <h1 class="text-4xl font-bold text-gray-700">Delete Profile </h1>

    <hr class="border-t border-gray-300 mt-3 mb-6">

    <div class="flex justify-between items-center px-3 py-1 bg-yellow-100 border border-yellow-300 text-yellow-700">
        <p>Please enter your password to continue.</p>
        <i class="fa fa-close text-gray-400 cursor-pointer hover:text-gray-500" aria-hidden="true"></i>
    </div>

    <form method="POST" action="#" class="mt-5">
        @csrf

        <div class="mt-2 mb-4 flex items-center">
            <label for="password" class="w-1/4 mr-5 text-right">Current Password:</label>

            <div class="w-2/4">
                <input id="password" type="password"
                       class="w-full border px-2 py-1 @error('password') is-invalid @enderror"
                       name="password"
                       placeholder="Current Password" required autocomplete="password">

                @error('password')
                <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <hr class="border-t border-gray-300 mt-8 my-5">

        <div class="float-right mt-2">
            <button type="submit" class="bg-blue-600 text-center text-white px-3 py-1 mr-2 hover:bg-blue-500">
                Continue
            </button>

            <a class="text-gray-600 hover:underline" href="#" id="cancel-post">
                Cancel
            </a>
        </div>
    </form>
</div>
