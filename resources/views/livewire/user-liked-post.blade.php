<div class="flex w-full mt-1 pt-2 pl-5">
    @foreach ($likedProfiles as $like)
        <img class="inline-block object-cover w-8 h-8 text-white border-2 border-white rounded-full shadow-sm cursor-pointer mr-2"
            src="{{ $like->user ? $like->user->image() : '' }}" alt="Perfil de usuario">
    @endforeach
</div>
