<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    public function index()
    {
        return view('todos', [
            'todos' => Todo::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'min:4',
        ]);

        Todo::create([
            'text' => $request->get('text'),
            'completed' => false,
        ]);

        return redirect('/');
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->completed = $request->get('completed') === 'on';

        $todo->save();

        return redirect('/');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect('/');
    }
}
