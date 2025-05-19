<x-layouts.app>
    <h1>/{{ $board->slug }}/ - {{ $board->title }}</h1>
    <p>{{ $board->description }}</p>

    <a href="/{{ $board->slug }}/create-thread">Create Thread</a>
</x-layouts.app>
