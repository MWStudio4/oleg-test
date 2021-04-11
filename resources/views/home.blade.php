<x-app-layout>

    <script type="application/json" data-settings-selector="mutated">@json($mutedIds)</script>

    <x-slot name="header">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('home') }}"></a>
            </div>
            <ul class="nav navbar-nav">
                @auth
                    <li><b>{{ Auth::user()->username }}</li></b>
                @else
                    <li><a href="{{ route('login') }}">Log in</a></li>

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                @endauth
            </ul>
        </nav>
    </x-slot>


    <div class="container mx-auto">
        <div class="my-4 sm:flex sm:items-end sm:ml-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>Sorting</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('home',['sort' => 'desc'])">
                        Newest first
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('home',['sort' => 'asc'])">
                        Oldest first
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('home')">
                        Random order
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="container mx-auto">
        <div class="flex justify-between">
            <div class="flex-initial">
                @foreach($posts as $post)
                    <x-post-card :post="$post" is-auth-user-post="{{ $user === null ? true : $post->user->id === $user->id }}" />
                @endforeach
            </div>
            <div class="flex-initial flex flex-col" x-data="{}">
                <select id="unmuteIds" class="form-select px-4 py-3" multiple>
                    @foreach($mutedUsers as $mutedUser)
                        <option value="{{ $mutedUser->id }}">{{ $mutedUser->username }}</option>
                    @endforeach
                </select>
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" @click="window.unmute()">Unmute selected</button>
            </div>
        </div>
    </div>
</x-app-layout>
