<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
{
    const URI = 'api/chats';

    /**
     * REST list (GET)
     *
     * @return void
     */
    public function test_list()
    {
        $response = $this->getJson(self::URI);
        $response->assertStatus(200);
    }

    /**
     * REST create (POST)
     *
     * @return void
     */
    public function test_create()
    {
        $response = $this->postJson(self::URI, [
            'name'      => 'My TEST chat',
            'author_id' => 1
        ]);
        
        $response
            ->assertStatus(201)
            ->assertJson([
                'id' => true,
            ]);

        $content = $response->getContent();
        $json = json_decode($content);
        return $json->id;
    }

    /**
     * REST read (GET)
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_read($id)
    {
        $response = $this->getJson(self::URI . "/{$id}");
        $response
            ->assertStatus(200)
            ->assertJson([
                'id'        => true,
                'name'      => true,
                'author_id' => true,
            ]);
    }

    /**
     * REST update (PUT)
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_update($id)
    {
        $name = 'My UPDATED chat';
        $response = $this->putJson(self::URI . "/{$id}", [
            'name'      => $name,
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'name' => $name,
            ]);
    }

    /**
     * REST delete (DELETE)
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_delete($id)
    {
        $response = $this->deleteJson(self::URI . "/{$id}");
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => true,
            ]);
    }
}