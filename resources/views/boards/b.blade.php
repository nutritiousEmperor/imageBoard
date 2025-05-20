<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>/{{ $board->slug }}/ - {{ $board->title }} - Catalog - 4Larachan</title>
    <style>
        
    </style>
    <script>
        function showCreateThreadForm() 
        {
            let form = document.querySelector('.createThread');
            let button = document.querySelector('.openCreateThreadFormButton');

            if(form.classList.contains('hidden')) 
            {
                button.innerHTML = 'Close Form';
                form.classList.remove('hidden');
            } else 
            {
                button.innerHTML = 'Create Thread';
                form.classList.add('hidden');
            }
        }
    </script>
</head>
<body>
    
<x-layouts.app>
    <h1>/{{ $board->slug }}/ - {{ $board->title }}</h1>
    <p>{{ $board->description }}</p>

    @auth
        <button onclick="showCreateThreadForm()" class="openCreateThreadFormButton">Create Thread</button>

        <form method="POST" class="createThread hidden" action="{{ route('threads.store', $board->slug) }}">
            @csrf
            <input type="text" name="title" placeholder="Title">
            <br>
            <input type="text" name="body" placeholder="Body">
            <br>
            <button type="submit">Create Form</button>
        </form>
    @endauth
</x-layouts.app>

</body>
</html>