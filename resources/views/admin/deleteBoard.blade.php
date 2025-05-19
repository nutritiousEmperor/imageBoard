<x-layouts.app>
    <div class="container">
        <h1>Delete a Board</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

       


            @foreach($boards as $board)
                <li> 
                    {{ $board->title}}
                    /{{ $board->slug}}/

                    <form action="{{ route('admin.destroyBoard', $board->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach


        </form>
    </div>
</x-layouts.app>
