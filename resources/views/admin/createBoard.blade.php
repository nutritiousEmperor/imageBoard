<x-layouts.app>
    <div class="container">
        <h1>Create New Board</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.createBoard') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Board Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug (e.g. gif)</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                @error('slug') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Board Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                @error('description') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Board</button>
        </form>
    </div>
</x-layouts.app>
