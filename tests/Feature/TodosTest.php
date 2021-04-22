<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodosTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_todos()
    {
        Todo::factory()->create([
            'text' => 'Test Todo',
        ]);
        Todo::factory()->create([
            'text' => 'Another Todo',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Test Todo');
        $response->assertSee('Another Todo');
    }

    public function test_it_can_create_a_todo()
    {
        $response = $this->post('/todos', [
            'text' => 'A Test Todo',
        ]);

        $response->assertRedirect('/');

        $response = $this->get('/');

        $response->assertSee('A Test Todo');
    }

    public function test_todos_must_be_at_least_four_characters_long()
    {
        $response = $this->post('/todos', [
            'text' => 'Oop',
        ]);

        $response->assertRedirect('/');

        $response = $this->get('/');

        $response->assertDontSee('Oop');
    }

    public function test_todos_can_be_deleted()
    {
        Todo::factory()->create([
            'id' => 1,
            'text' => 'Test Todo',
        ]);

        $response = $this->get('/');
        $response->assertSee('Test Todo');

        $response = $this->delete('/todos/1');
        $response->assertRedirect('/');

        $response = $this->get('/');
        $response->assertDontSee('Test Todo');
    }

    public function test_todos_can_be_completed()
    {
        Todo::factory()->create([
            'id' => 1,
            'text' => 'Test Todo',
            'completed' => false,
        ]);

        $response = $this->patch('/todos/1', [
            'completed' => 'on',
        ]);
        $response->assertRedirect('/');

        $this->assertDatabaseHas('todos', [
            'id' => 1,
            'completed' => true,
        ]);
    }

    public function test_todos_can_be_uncompleted()
    {
        Todo::factory()->create([
            'id' => 1,
            'text' => 'Test Todo',
            'completed' => true,
        ]);

        $response = $this->patch('/todos/1', []);
        $response->assertRedirect('/');

        $this->assertDatabaseHas('todos', [
            'id' => 1,
            'completed' => false,
        ]);
    }
}
