<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testTaskCanBeCreated()
    // {
    //     $user = factory(User::class)->create(); 
    
    //     $response = $this->post('/api/tasks', [
    //         'title' => 'New Task',
    //         'description' => 'This is a test task',
    //         'user_id' => 1,
    //     ]);
    
    //     $response->assertStatus(201);
    //     $response->assertJson(['message' => 'success store task']);
    // }

    public function testTaskCreationFailsOnValidation()
    {
        $response = $this->post('/api/tasks', [
            'title' => '', 
            'user_id' => 123, 
        ]);

        $response->assertStatus(422); 
        $response->assertJsonValidationErrors(['title', 'user_id']);
    }
}
