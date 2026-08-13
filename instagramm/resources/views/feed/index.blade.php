<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Feed</h2>
      @auth
        <a href="{{ route('posts.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Create Post</a>
      @endauth
    </div>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main feed (center) -->
        <div class="lg:col-span-2">
          <div class="space-y-6">
            <!-- Grid on medium+ screens (Instagram-like) -->
            <div class="hidden md:grid grid-cols-2 lg:grid-cols-3 gap-4">
              @foreach($posts as $post)
                <a href="{{ route('posts.show', $post) }}" class="block rounded overflow-hidden">
                  <img src="{{ asset('storage/' . $post->image) }}" alt="post" class="w-full aspect-square object-cover">
                </a>
              @endforeach
            </div>

            <!-- List view on small screens -->
            <div class="md:hidden space-y-6">
              @foreach($posts as $post)
                <x-post-card :post="$post" />
              @endforeach
            </div>

            <div class="mt-6">
              {{ $posts->links() }}
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <aside class="hidden lg:block">
          <div class="bg-white dark:bg-gray-800 rounded shadow p-4 mb-4">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Create</h3>
            <p class="text-xs text-gray-500">Share a photo with your followers.</p>
            @auth
              <a href="{{ route('posts.create') }}" class="mt-3 inline-block px-3 py-2 bg-blue-600 text-white rounded text-sm">Create Post</a>
            @else
              <a href="{{ route('login') }}" class="mt-3 inline-block px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded text-sm">Login to post</a>
            @endauth
          </div>

          <div class="bg-white dark:bg-gray-800 rounded shadow p-4">
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Recent</h3>
            <ul class="mt-3 space-y-3 text-sm text-gray-600 dark:text-gray-400">
              @foreach($recent as $r)
                <li class="flex items-center">
                  <img src="{{ asset('storage/' . $r->image) }}" class="h-12 w-12 object-cover rounded mr-3">
                  <div>
                    <div class="font-medium text-gray-800 dark:text-gray-100">{{ $r->user->name }}</div>
                    <div class="text-xs text-gray-500">{{ $r->created_at->diffForHumans() }}</div>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </div>
</x-app-layout>
