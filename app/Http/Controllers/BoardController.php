<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createBoard');
    }

    private function copyTemplate($validated)
    {
        $template = resource_path("views/boards/template.txt");
        $boardFile = resource_path('views/boards/'.$validated['slug'].'.blade.php');
        if(!copy($template, $boardFile)) 
        {
            \Log::error("Error. Failed to save ${boardFile}. Please manually copy the board template. To ${boardFile}.");
        } else
        {
            \Log::error("Saved ${boardFile} successfully.");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'required|string|alpha_dash|unique:boards,slug',
        ]);

        $this->copyTemplate($validated);
        Board::create($validated);
        return redirect()->route('admin.createBoard')->with('success', 'Board created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
        $viewPath = "boards.$board->slug";
        
        if(View::exists($viewPath)) {
            return view($viewPath, compact('board'));
        }

        abort(404);
    }

    public function showAllBoards()
    {
        $boards = Board::all();
        return view('admin.deleteBoard', compact('boards'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Board $board)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        $filePath = resource_path('views/boards/'.$board->slug.'.blade.php');
        if(file_exists($filePath))
        {
            unlink($filePath);
        } else {
            \Log::error("Error. Failed to delete ${filePath}. Please manually delete the file.");
        }

        $board->delete();
        return redirect()->route('admin.deleteBoard')->with('success', 'Board deleted successfully.');
    }
}
