<div class="bg-gray-100 border border-gray-200">
    <header class="flex items-center m-5">
        <div class="bg-white border border-gray-400 p-xs mr-3">
            <a href="#">
                <img src="#" alt="#" width="50">
            </a>
        </div>
        <div class="text-base">
            <p class="text-blue-500 leading-4 font-bold">
                <a href="#">
                    Name
                </a>
            </p>
            <p class="font-bold text-gray-500">
                <a href="#">
                    @ username
                </a>
            </p>
        </div>
    </header>

    <hr class="border-t border-gray-300 mx-3 my-2">

    <section class="mt-1 mb-4">
        <nav>
            @yield('sidebar-menu')

            <hr class="border-t border-gray-300 mx-3 my-2">

            <ul>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="w-full px-5 py-1 text-left text-blue-500 hover:bg-gray-200">
                            <i class="fa fa-sign-out-alt mr-1" aria-hidden="true"></i>
                            Sign out
                        </button>
                    </form>
                </li>

                @if( Route::current()->getName() !== 'home' )
                    <li>
                        <a href="{{route('home')}}" class="block px-5 py-1 text-blue-500 hover:bg-gray-200">
                            <i class="fa fa-home mr-1" aria-hidden="true"></i>
                            Back to Home
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </section>
</div>
