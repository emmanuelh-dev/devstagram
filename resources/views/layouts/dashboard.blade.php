@extends('layouts.app')

@section('content')
    <!-- component -->
    <div class="bg-gray-100">

        <main class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-5 lg:mx-12 w-2xl container px-2 w-full">

            <aside class="">

                <div class="bg-white shadow rounded-lg p-4">
                    <div class="flex flex-col gap-1 text-center items-center">
                        <img class="h-32 w-32 bg-white p-2 rounded-full shadow mb-4"
                            src="{{ $user->url() }}" alt="">
                            {{-- src="{{ asset('profiles') . '/' . $user->image }}" alt=""> --}}
                        <div class="flex items-center gap-2">
                            <p class="font-semibold">{{ $user->username }}</p>
                            @auth
                                @if ($user->id === auth()->user()->id)
                                    <a href="{{ route('perfil.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                            class="w-4 h-4">
                                            <path fill-rule="evenodd"
                                                d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    @if ($user->following(auth()->user()))
                                        <form method="POST" action="{{ route('users.unfollow', $user) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 px-2 py-2 rounded-xl text-white text-sm">
                                                Unfollow
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('users.follow', $user) }}">
                                            @csrf
                                            <button type="submit" href=""
                                                class="bg-blue-500 px-2 py-2 rounded-xl text-white text-sm">
                                                Follow
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endauth
                        </div>
                        <div class="text-sm leading-normal text-gray-400 flex justify-center items-center">
                            Live a life you will remember.
                        </div>
                    </div>

                    <div class="flex justify-center items-center gap-2 my-3">
                        <div class="font-semibold text-center mx-4">
                            <p class="text-black">{{ $user->posts->count() }}</p>
                            <span class="text-gray-400">Posts</span>
                        </div>
                        <div class="font-semibold text-center mx-4">
                            <p class="text-black">{{ $user->followers->count() }}</p>
                            <span class="text-gray-400">Followers</span>
                        </div>
                        <div class="font-semibold text-center mx-4">
                            <p class="text-black">{{ $user->followings->count() }}</p>
                            <span class="text-gray-400">Folowing</span>
                        </div>
                    </div>
                </div>

                @include('posts.create')

                <div class="bg-white shadow mt-6  rounded-lg p-6">
                    <h3 class="text-gray-600 text-sm font-semibold mb-4">Following</h3>
                    <ul class="flex items-center justify-center space-x-2">
                        @foreach ($user->followings as $follower)
                            <li class="flex flex-col items-center space-y-2">
                                <a class="block bg-white p-1 rounded-full" href="{{ route('post.index', $follower->username) }}">
                                    <img class="w-16 rounded-full" src="{{ asset('profiles/' . $follower->image) }}">
                                </a>
                                <span class="text-xs text-gray-500">
                                    {{ $follower->username }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="flex bg-white shadow mt-6  rounded-lg p-2">
                    <img src="https://images.unsplash.com/photo-1439130490301-25e322d88054?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1189&amp;q=80"
                        alt="Just a flower" class=" w-16  object-cover  h-16 rounded-xl">
                    <div class="flex flex-col justify-center w-full px-2 py-1">
                        <div class="flex justify-between items-center ">
                            <div class="flex flex-col">
                                <h2 class="text-sm font-medium">Massive Dynamic</h2>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-500 hover:text-blue-400 cursor-pointer" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </div>
                        <div class="flex pt-2  text-sm text-gray-400">
                            <div class="flex items-center mr-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <p class="font-normal">4.5</p>
                            </div>
                            <div class="flex items-center font-medium text-gray-900 ">
                                $1800
                                <span class="text-gray-400 text-sm font-normal"> /wk</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid mt-5 grid-cols-2  space-x-4 overflow-y-scroll flex justify-center items-center w-full ">
                    <div class="relative flex flex-col justify-between   bg-white shadow-md rounded-3xl  bg-cover text-gray-800  overflow-hidden cursor-pointer w-full object-cover object-center rounded shadow-md h-64 my-2"
                        style="background-image:url('https://images.unsplash.com/reserve/8T8J12VQxyqCiQFGa2ct_bahamas-atlantis.jpg?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80')">
                        <div class="absolute bg-gradient-to-t from-green-400 to-blue-400  opacity-50 inset-0 z-0"></div>
                        <div class="relative flex flex-row items-end  h-72 w-full ">
                            <div class="absolute right-0 top-0 m-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-9 w-9 p-2 text-gray-200 hover:text-blue-400 rounded-full hover:bg-white transition ease-in duration-200 "
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                            </div>
                            <div class="p-6 rounded-lg  flex flex-col w-full z-10 ">
                                <h4 class="mt-1 text-white text-xl font-semibold  leading-tight truncate">Loremipsum..
                                </h4>
                                <div class="flex justify-between items-center ">
                                    <div class="flex flex-col">
                                        <h2 class="text-sm flex items-center text-gray-300 font-normal">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Dubai
                                        </h2>
                                    </div>
                                </div>
                                <div class="flex pt-4  text-sm text-gray-300">
                                    <div class="flex items-center mr-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <p class="font-normal">4.5</p>
                                    </div>
                                    <div class="flex items-center font-medium text-white ">
                                        $1800
                                        <span class="text-gray-300 text-sm font-normal"> /wk</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative flex flex-col justify-between   bg-white shadow-md  rounded-3xl  bg-cover text-gray-800  overflow-hidden cursor-pointer w-full object-cover object-center rounded shadow-md h-64 my-2"
                        style="background-image:url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=80')">
                        <div class="absolute bg-gradient-to-t from-blue-500 to-yellow-400  opacity-50 inset-0 z-0"></div>
                        <div class="relative flex flex-row items-end  h-72 w-full ">
                            <div class="absolute right-0 top-0 m-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-9 w-9 p-2 text-gray-200 hover:text-blue-400 rounded-full hover:bg-white transition ease-in duration-200 "
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                            </div>
                            <div class="p-5 rounded-lg  flex flex-col w-full z-10 ">
                                <h4 class="mt-1 text-white text-xl font-semibold  leading-tight truncate">Loremipsum..
                                </h4>
                                <div class="flex justify-between items-center ">
                                    <div class="flex flex-col">
                                        <h2 class="text-sm flex items-center text-gray-300 font-normal">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            India
                                        </h2>
                                    </div>
                                </div>
                                <div class="flex pt-4  text-sm text-gray-300">
                                    <div class="flex items-center mr-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        <p class="font-normal">4.5</p>
                                    </div>
                                    <div class="flex items-center font-medium text-white ">
                                        $1800
                                        <span class="text-gray-300 text-sm font-normal"> /wk</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </aside>

            <article>
                @if ($posts->count())
                    @foreach ($posts as $post)
                        <x-post-card :post="$post" :user="$user" />
                    @endforeach
                @else
                    <p class="text-center">No post yet</p>
                @endif
            </article>
        </main>

    </div>
@endsection
