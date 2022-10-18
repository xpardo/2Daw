<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class MessageTest extends TestCase
{
    const URI = 'api/chats/{chat}/messages';

    public function test_create_chat() 
    {
        // Fake user
        $user = User::factory()->create();
        // Nested resources dependency: chat
        $response = $this->postJson('api/chats', [
            'name'      => 'My TEST chat',
            'author_id' => $user->id
        ]);
        $response->assertStatus(201);
        $content = $response->getContent();
        $json = json_decode($content);
        // Build nested route
        $uri = str_replace('{chat}', $json->id, self::URI);
        return $uri;
    }

    /**
     * REST list (GET)
     *
     * @return void
     * 
     * @depends test_create_chat
     */
    public function test_list($uri) 
    {
        $response = $this->get($uri);
        $response->assertStatus(200);
    }

    /**
     * REST create (POST)
     *
     * @return void
     * 
     * @depends test_create_chat
     */
    public function test_create($uri)
    {
        // Fake user
        $user = User::factory()->create();
        // POST request
        $response = $this->postJson($uri, [
            'message' => "Hola Test",
            'author_id' => $user->id
        ]);
        $response->assertStatus(201);
        $json = json_decode($response->getContent());
        return "{$uri}/{$json->id}";
    }

    /**
     * REST read (GET)
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_read($uri) 
    {
        $response = $this->get($uri);
        $response->assertStatus(200);
    }

    /**
     * REST update (PUT)
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_update($uri) 
    {
        $response = $this->put($uri, [
            'message' => "Hello World, Test is here"
        ]);
        $response->assertStatus(200);
    }

    /**
     * REST delete (DELETE)
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_delete($uri) 
    {
        $response = $this->delete($uri);
        $response->assertStatus(200);
    }
}