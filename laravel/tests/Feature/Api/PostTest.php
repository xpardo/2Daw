<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\File;
use Laravel\Sanctum\Sanctum;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Visibility;


use Illuminate\Http\UploadedFile;

class PostTest extends TestCase
{
    public static User $testUser;
    public static array $validData = [];
    public static array $invalidData = [];



    public function test_post_first()
    {
        // Desem l'usuari al primer test
        self::$testUser->save();
        // Comprovem que s'ha creat
        $this->assertDatabaseHas('users', [
            'email' => self::$testUser->email,
        ]);
    }




    public function test_post_list()
    {
        // List all files using API web service
        $response = $this->getJson("/api/posts");
        // Check OK response
        $this->_test_ok($response);
    }

    public function test_post_create(): object
    {
        // Upload fake file using API web service
        $response = $this->postJson("/api/posts", self::$validData);
        // Check OK response
        $this->_test_ok($response, 201);
        // Check validation errors
        $params = array_keys(self::$validData);
        $response->assertValid($params);
        // Check JSON dynamic values
        $response->assertJsonPath(
            "data.id",
            fn($id) => !empty($id)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
    }



    public function test_post_update():object
    {
        // Create fake file
        $name = "fto.png";
        $size = 38960; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake file using API web service
        $response = $this->putJson("/api/posts/", [
            "upload" => $upload,
        ]);
        // Check OK response
        $this->_test_ok($response);
        // Check validation errors
        $response->assertValid(["upload"]);
        // Check JSON exact values
        $response->assertJsonPath("data.filesize", $size * 1024);
        // Check JSON dynamic values
        $response->assertJsonPath(
            "data.filepath",
            fn($filepath) => str_contains($filepath, $name)
        );
    }
    public function test_post_update_error(object $post)
    {
        // Create fake file with invalid max size
        $name = "photo.jpg";
        $size = 3000; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // Upload fake file using API web service
        $response = $this->putJson("/api/posts/{$post->id}", [
            "upload" => $upload,
        ]);
        // Check ERROR response
        $this->_test_error($response);
    }
    public function test_post_update_notfound()
    {
        $id = "not_exists";
        $response = $this->putJson("/api/posts/{$id}", []);
        $this->_test_notfound($response);
    }

    public function test_post_delete(object $post)
    {
        // Delete one file using API web service
        $response = $this->deleteJson("/api/posts/{$post->id}");
        // Check OK response
        $this->_test_ok($response);
    }
    public function test_post_delete_notfound()
    {
        $id = "not_exists";
        $response = $this->deleteJson("/api/posts/{$id}");
        $this->_test_notfound($response);
    }

    protected function _test_ok($response, $status = 200)
    {
        // Check JSON response
        $response->assertStatus($status);
        // Check JSON properties
        $response->assertJson([
            "success" => true,
            "data" => true // any value
        ]);
    }
    protected function _test_error($response)
    {
        // Check response
        $response->assertStatus(404);
        // Check validation errors
        $response->assertInvalid(["upload"]);
        // Check JSON properties
        $response->assertJson([
            "message" => true,
            // any value
            "errors" => true, // any value
        ]);
        // Check JSON dynamic values
        $response->assertJsonPath(
            "message",
            fn($message) => !empty($message) && is_string($message)
        );
        $response->assertJsonPath(
            "errors",
            fn($errors) => is_array($errors)
        );
    }
    protected function _test_notfound($response)
    {
        // Check JSON response
        $response->assertStatus(404);
        // Check JSON properties
        $response->assertJson([
            "success" => false,
            "message" => true // any value
        ]);
        // Check JSON dynamic values
        $response->assertJsonPath(
            "message",
            fn($message) => !empty($message) && is_string($message)
        );
    }

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        // Creem usuari/a de prova
        $name = "test_" . time();
        self::$testUser = new User([
            "name" => "{$name}",
            "email" => "{$name}@mailinator.com",
            "password" => "12345678"
        ]);
        $name = "avatar.png";
        $size = 500; /*KB*/
        $upload = UploadedFile::fake()->image($name)->size($size);
        // TODO Omplir amb dades vàlides
        self::$validData = [
            "body" => "Cos de prova",
            "upload" => $upload,
            "latitude" => 41.2,
            "longitude" => 23.4
        ];
        // TODO Omplir amb dades incorrectes
        self::$invalidData = [
            "body" => "",
            "upload" => $upload,
            "latitude" => "error",
            "longitude" => "error"
        ];
    }
  
    public function test_post_last()
    {
        // Eliminem l'usuari al darrer test
        self::$testUser->delete();
        // Comprovem que s'ha eliminat
        $this->assertDatabaseMissing('users', [
            'email' => self::$testUser->email,
        ]);
    }
}