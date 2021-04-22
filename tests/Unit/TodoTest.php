<?php

namespace Tests\Unit;

use App\Models\Todo;
use PHPUnit\Framework\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_todo_form_id()
    {
        $todo = new Todo();
        $todo->id = 1;

        $this->assertSame('todo-1', $todo->formId());
    }
}
