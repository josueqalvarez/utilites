<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ToDo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = ToDo::query();

        if ($request->has('description') && !empty($request->input('description'))) {
            $query->where('description', 'like', '%' . $request->input('description') . '%');
        }

        if ($request->has('category_id') && !empty($request->input('category_id'))) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->has('completed') && !is_null($request->input('completed'))) {
            $query->where('completed', $request->input('completed'));
        }

        $query->where('user_id', \Auth::id());

        $toDos = $query->get();

        $categories = Category::all();

        return view('toDos.index', compact('toDos', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $request->user()->toDos()->create($validated);

        return redirect()->route('toDos.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ToDo $toDo): View
    {
        $categories = Category::all();
        return view('toDos.edit', compact('toDo', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToDo $toDo): RedirectResponse
    {
        $request->validate([
            'description' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $toDo->update($request->all());

        return redirect()->route('toDos.index')->with('success', 'Tarea actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ToDo $toDo)
    {
        $toDo->delete();
        return redirect()->route('toDos.index');
    }

    /**
     * Mark a to do as done
     */
    public function toggle(ToDo $toDo): RedirectResponse
    {
        $toDo->update(['completed' => !$toDo->completed]);
        return redirect()->route('toDos.index');
    }
}
