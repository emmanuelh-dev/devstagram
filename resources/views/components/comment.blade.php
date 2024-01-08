<div class="text-black px-4 py-2 antialiased flex">
    @if ($comment->user->image)
        <img class="rounded-full h-8 w-8 mr-2 mt-1 " src="{{ $comment->user->url() }}">
        {{-- <img class="rounded-full h-8 w-8 mr-2 mt-1 " src="{{ asset('profiles') . '/' . $comment->user->image }}"> --}}
    @else
        <div class="rounded-full h-8 w-8 mr-2 mt-1 bg-gray-100 flex items-center justify-center text-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                    d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    @endif

    <div>
        <div class="bg-gray-100 rounded-lg px-3 pt-2 pb-2.5">
            <a href="{{ route('post.index', $comment->user) }}"
                class="text-gray-600 text-sm font-semibold">{{ $comment->user->username }}</a>
            <div class="text-xs leading-snug md:leading-normal">{{ $comment->comment }}</div>
        </div>
        <div class="text-xs  mt-0.5 text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
    </div>
</div>
