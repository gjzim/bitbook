<div class="flex justify-between">
    <div class="w-3/4 mr-10">
        <h1 class="text-4xl font-bold text-gray-700">Edit Profile</h1>

        <hr class="border-t border-gray-300 mt-3 mb-6">

        <form method="POST" action="#" class="mx-auto">
            @csrf

            <div class="mt-2 mb-4 flex items-center">
                <label for="name" class="w-1/4 mr-5 text-right">Name:</label>

                <div class="w-2/4">
                    <input id="name" type="text" class="w-full border px-2 py-1 @error('name') is-invalid @enderror"
                           name="name"
                           value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name">

                    @error('name')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="mt-2 mb-4 flex items-center">
                <label for="username" class="w-1/4 mr-5 text-right">Username:</label>

                <div class="w-2/4">
                    <input id="username" type="text"
                           class="w-full border px-2 py-1 @error('username') is-invalid @enderror"
                           name="username"
                           value="{{ old('username') }}" placeholder="Username" required autocomplete="username">

                    @error('username')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="mt-2 mb-4 flex items-center">
                <label for="email" class="w-1/4 mr-5 text-right">Email:</label>

                <div class="w-2/4">
                    <input id="email" type="email" class="w-full border px-2 py-1 @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email">

                    @error('email')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="mt-2 mb-4 flex items-center">
                <label for="tag" class="w-1/4 mr-5 text-right">Tagline:</label>

                <div class="w-2/4">
                    <input id="tag" type="text" class="w-full border px-2 py-1 @error('tag') is-invalid @enderror"
                           name="tag"
                           value="{{ old('tag') }}" placeholder="Enter your tag line" required autocomplete="tag">

                    @error('tag')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="mt-2 mb-4 flex items-center">
                <label for="sex" class="w-1/4 mr-5 text-right">Sex:</label>

                <div class="w-2/4 flex items-center">
                    <input id="sex" type="radio" name="sex" value="male"
                           class="mr-1" {{ old('sex')=='male' ? 'checked' : '' }}> Male
                    <input id="sex" type="radio" name="sex" value="female"
                           class="ml-3 mr-1" {{ old('sex')=='female' ? 'checked' : '' }}> Female

                    @error('sex')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="mt-2 mb-4 flex items-center">
                <label for="birthday" class="w-1/4 mr-5 text-right">Birthday:</label>

                <div class="w-2/4">
                    <input id="birthday" type="text"
                           class="w-full border px-2 py-1 @error('birthday') is-invalid @enderror"
                           name="birthday"
                           value="{{ old('birthday') }}" placeholder="Select your birthday" required
                           autocomplete="birthday">

                    @error('birthday')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="mt-2 mb-4 flex items-center">
                <label for="country" class="w-1/4 mr-5 text-right">Country:</label>

                <div class="w-2/4">
                    <select name="country" id="country" class="w-full border px-2 py-1">
                        @for($i=0;$i<5;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>

                    @error('country')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="mt-2 mb-4 flex">
                <label for="address" class="w-1/4 mr-5 text-right">Address:</label>

                <div class="w-2/4">
                    <textarea name="address" id="address" cols="30" rows="3"
                              class="w-full border px-2 py-1 @error('address') is-invalid @enderror">{{ old('address') }}</textarea>

                    @error('address')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="mt-2 mb-4 flex">
                <label for="about" class="w-1/4 mr-5 text-right">About Me:</label>

                <div class="w-2/4">
                    <textarea name="about" id="about" cols="30" rows="5"
                              class="w-full border px-2 py-1 @error('about') is-invalid @enderror">{{ old('about') }}</textarea>

                    @error('about')
                    <span class="text-sm text-red-500" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>


            <hr class="border-t border-gray-300 mt-8 my-5">

            <div class="float-right mt-2">
                <button type="submit" class="bg-blue-600 text-center text-white px-3 py-1 mr-2 hover:bg-blue-500">
                    Save
                </button>

                <a class="text-gray-600 hover:underline" href="#" id="cancel-post">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <div class="w-1/4">
        <div class="mt-5 p-1 border border-gray-300">
            <img src="/img/user.jpg" alt="" class="mx-auto w-full">
        </div>
        <div>
            <button
                class="block mx-auto mt-2 w-full py-2 border border-gray-300 bg-gray-200 hover:bg-gray-300 text-black">
                <i class="fa fa-camera mr-1" aria-hidden="true"></i>
                Upload Photo
            </button>
        </div>
    </div>
</div>
