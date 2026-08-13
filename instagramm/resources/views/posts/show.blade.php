<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
          <div class="bg-white shadow rounded mb-6">
            <div class="p-4 border-b flex items-start space-x-4">
              <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center text-sm font-semibold text-gray-700">{{ strtoupper(substr($post->user->name,0,1)) }}</div>
              <div>
                <div class="font-semibold">{{ $post->user->name }}</div>
                <div class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
              </div>
            </div>

            <div>
              <img src="{{ asset('storage/' . $post->image) }}" class="w-full max-h-[640px] object-contain bg-black">
            </div>

            <div class="p-4">
              <p class="text-gray-800">{{ $post->caption }}</p>
            </div>
          </div>
        </div>

        <aside>
          <div class="bg-white shadow rounded p-4 mb-6">
            <h3 class="font-semibold">Comments ({{ $post->comments->count() }})</h3>
            <div class="mt-4 space-y-4 max-h-[60vh] overflow-auto">
              @foreach($post->comments as $comment)
                <div class="flex items-start space-x-3">
                  <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold text-gray-700">{{ strtoupper(substr($comment->user->name,0,1)) }}</div>
                  <div class="flex-1">
                    <div class="text-sm font-medium">{{ $comment->user->name }} <span class="text-xs text-gray-500">• {{ $comment->created_at->diffForHumans() }}</span></div>
                    <div class="text-sm mt-1">{{ $comment->comment }}</div>
                  </div>
                </div>
              @endforeach
            </div>

            @auth
              <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="comment" rows="3" class="w-full border rounded p-2" placeholder="Write a comment..."></textarea>
                @error('comment') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                <div class="mt-2 text-right">
                  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Comment</button>
                </div>
              </form>
            @else
              <div class="text-sm text-gray-500 mt-4">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> to comment.</div>
            @endauth
          </div>
        </aside>
      </div>

      <div class="mt-4">
        <a href="{{ route('feed') }}" class="text-blue-500">&larr; Back to feed</a>
      </div>
    </div>
  </div>
</x-app-layout>
