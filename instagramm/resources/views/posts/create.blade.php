<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Post</h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Image</label>
          <input type="file" name="image" required class="mt-1 block w-full">
          @error('image') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Caption</label>
          <textarea name="caption" rows="3" class="mt-1 block w-full border rounded p-2">{{ old('caption') }}</textarea>
          @error('caption') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Post</button>
      </form>
    </div>
  </div>
</x-app-layout>
