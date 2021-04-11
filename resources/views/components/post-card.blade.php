<div id="post-{{ $post->id }}" class="my-2 max-w-lg mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl" x-data="{
 userId: {{ $post->user->id }},
}">
    <div class="md:flex">
        <div class="md:flex-shrink-0">
            <img class="h-64 w-full object-cover md:w-48" src="{{ $post->image ?? 'noimage.png' }}" alt="{{ $post->title }}">
        </div>
        <div class="p-8">
            <div class="mb-2">{{ $post->created_at->diffForHumans() }}</div>
            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $post->title }}</div>
            <p class="mt-2 text-gray-500">{{ $post->body }}</p>
            <span class="block mt-3 text-lg leading-tight font-medium text-black hover:underline cursor-pointer" @click="window.mute({{ $post->user->id }}, '{{ $post->user->username }}')">Mute <b>{{ $post->user->username }} ( {{ $post->user->id }})</b></span>
        </div>
    </div>
</div>
