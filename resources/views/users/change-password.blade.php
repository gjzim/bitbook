<div class="">
    <h1 class="text-4xl font-bold text-gray-700">Change Password </h1>

    <hr class="border-t border-gray-300 mt-3 mb-6">

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

        <div class="mt-2 mb-4 flex items-center">
            <label for="new-password" class="w-1/4 mr-5 text-right">New Password:</label>

            <div class="w-2/4">
                <input id="new-password" type="password"
                       class="w-full border px-2 py-1 @error('new-password') is-invalid @enderror"
                       name="new-password"
                       placeholder="Current Password" required autocomplete="new-password">

                @error('new-password')
                <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>

        <div class="mt-2 mb-4 flex items-center">
            <label for="new-password" class="w-1/4 mr-5 text-right">Confirm Password:</label>

            <div class="w-2/4">
                <input id="confirm-password" type="password"
                       class="w-full border px-2 py-1 @error('confirm-password') is-invalid @enderror"
                       name="confirm-password"
                       placeholder="Current Password" required autocomplete="confirm-password">

                @error('confirm-password')
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
