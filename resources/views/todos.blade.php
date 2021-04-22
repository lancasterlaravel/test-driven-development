<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test Driven Development</title>

        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="antialiased bg-gray-900">
        <div class="max-w-7xl mx-auto mt-24 px-4 sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto">
                <div class="pb-5 border-b border-gray-800">
                    <h1 class="text-lg leading-6 font-medium text-gray-100">
                        Todos
                    </h1>
                </div>

                <ul class="space-y-3 mt-8">
                    @foreach($todos as $todo)
                        <li class="flex items-center justify-between bg-gray-800 text-gray-100 text-lg shadow overflow-hidden px-4 py-4 sm:px-6 sm:rounded-md">
                            <form id="{{ $todo->formId() }}" method="POST" action="/todos/{{ $todo->id }}">
                                @csrf
                                @method('PATCH')
                                <label class="flex items-center">
                                    <input type="checkbox" name="completed" @if($todo->completed) checked @endif onchange="document.getElementById('{{ $todo->formId() }}').submit()" class="form-checkbox rounded text-blue-500" />
                                    <span class="ml-2">{{ $todo->text }}</span>
                                </label>
                            </form>

                            <form method="POST" action="/todos/{{ $todo->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center text-gray-300 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-24 pb-5 border-b border-gray-800">
                    <h1 id="new-todo-label" class="text-lg leading-6 font-medium text-gray-100">
                        Add new todo
                    </h1>
                </div>

                <form method="POST" action="/todos">
                    @csrf
                    <div class="flex rounded-md shadow-sm">
                        <div class="relative flex items-stretch flex-grow focus-within:z-10">
                            <input type="text" name="text" id="new-todo" aria-labelledby="new-todo-label" class="text-white bg-gray-800 focus:ring-blue-500 focus:border-blue-500 block w-full rounded-none rounded-l-md sm:text-sm border-gray-700" placeholder="Something to do..." autocomplete="off">
                        </div>
                        <button class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-700 text-sm font-medium rounded-r-md text-gray-300 bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" />
                            </svg>
                            <span>Add</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
