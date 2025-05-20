<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ThreadController extends Controller
{
    /**
     * Show the form for creating a new thread.
     */
    public function create(Board $board)
    {
        $viewPath = "threads.create";

        if (View::exists($viewPath)) {
            return view($viewPath, compact('board'));
        }

        abort(404);
    }

    /**
     * Store a newly created thread in storage.
     */
    public function store(Request $request, Board $board)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        $thread = Thread::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'board_id' => $board->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('threads.show', [$board->slug, $thread->id])->with('success', 'Thread created successfully.');

    }

    /**
     * Display the specified thread.
     */
    public function show(Board $board, Thread $thread)
{
    // Optional: Verify the thread belongs to the board, for security:
    if ($thread->board_id !== $board->id) {
        abort(404);
    }

    $viewPath = "threads.show";

    if (View::exists($viewPath)) {
        return view($viewPath, compact('thread', 'board'));
    }

    abort(404);
}


    /**
     * Remove the specified thread from storage.
     */
    public function destroy(Thread $thread)
    {
        try {
            $thread->delete();
        } catch (\Exception $e) {
            \Log::error("Error deleting thread ID {$thread->id}: {$e->getMessage()}");
            return back()->withErrors('Failed to delete thread.');
        }

        return back()->with('success', 'Thread deleted successfully.');
    }
}
