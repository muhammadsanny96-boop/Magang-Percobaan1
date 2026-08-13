@props(['post'])

<div class="bg-white shadow rounded mb-6 overflow-hidden">
  <!-- Header -->
  <div class="p-3 flex items-center justify-between">
    <div class="flex items-center">
      <div class="h-10 w-10 rounded-full bg-gray-200 overflow-hidden flex items-center justify-center mr-3">
        @if(optional($post->user)->profile_photo_path)
          <img src="{{ asset('storage/' . $post->user->profile_photo_path) }}" alt="avatar" class="h-full w-full object-cover">
        @else
          <span class="text-sm font-semibold text-gray-700">{{ strtoupper(substr($post->user->name,0,1)) }}</span>
        @endif
      </div>
      <div>
        <div class="text-sm font-semibold text-gray-800">{{ $post->user->name }}</div>
        <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
      </div>
    </div>
    <div class="text-gray-400">...
    </div>
  </div>

  <!-- Image -->
  <div class="w-full bg-black">
    <img src="{{ asset('storage/' . $post->image) }}" class="w-full aspect-square object-cover">
  </div>

  <!-- Actions -->
  <div class="p-3 flex items-center justify-between">
    <div class="flex items-center space-x-4">
      <button class="text-gray-700">Like</button>
      <a href="{{ route('posts.show', $post) }}#comments" class="text-gray-700">Comment</a>
      <button class="text-gray-700">Share</button>
    </div>
    <button class="text-gray-700">Save</button>
  </div>

  <!-- Caption -->
  <div class="px-4 pb-4">
    <div class="text-sm"><span class="font-semibold mr-2">{{ $post->user->name }}</span>{{ $post->caption }}</div>
    <a href="{{ route('posts.show', $post) }}#comments" class="text-xs text-gray-500 mt-2 inline-block">View comments</a>
  </div>
</div>
