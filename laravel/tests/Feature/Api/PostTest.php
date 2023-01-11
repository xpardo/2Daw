<?php
namespace Tests\Feature;
 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\File;
use App\Models\User;
use App\Models\Post;
use Laravel\Sanctum\Sanctum;
use Illuminate\Testing\Fluent\AssertableJson;

class PostTest extends TestCase
{
    public static User $testUser;
    public static array $validData = [];
    public static array $invalidData = [];
   
    public static function setUpBeforeClass() : void
    {
        parent::setUpBeforeClass();
        // Creem usuari/a de prova
        $name = "test_" . time();
        self::$testUser = new User([
            "name"      => "{$name}",
            "email"     => "{$name}@mailinator.com",
            "password"  => "12345678"
        ]);
        // TODO Omplir amb dades vàlides
        self::$validData = [
            'body' => 'prova',
            'upload' => $upload,
            'latitude'    => '6.44',
            'longitude'   => '6.44',
            'visibility_id'   => '1',

        ];
        // TODO Omplir amb dades incorrectes
        self::$invalidData = [
            'body' => '1',
            'upload' => $upload,
            'latitude'    => '1',
            'longitude'   => '1',
            'visibility_id'   => '1',
        ];
    }

    public function test_post_list()
    {
        // Desem l'usuari al primer test
        self::$testUser->save();
        // Comprovem que s'ha creat
        $this->assertDatabaseHas('users', [
            'email' => self::$testUser->email,
        ]);
        // List all files using API web service
        $response = $this->getJson("/api/posts");
        // Check OK response
        $this->_test_ok($response);
        // Check JSON dynamic values
        $response->assertJsonPath("data",
            fn ($data) => is_array($data)
        );
    }
  
    public function test_post_first()
    {
        // Desem l'usuari al primer test
        self::$testUser->save();
        // Comprovem que s'ha creat
        $this->assertDatabaseHas('users', [
            'email' => self::$testUser->email,
        ]);
    }
 

  
    public function test_post_create()
    {
        Sanctum::actingAs(self::$testUser);
        // Cridar servei web de l'API
        $response = $this->postJson("/api/posts", self::$validData);
        // Revisar que no hi ha errors de validació
        $params = array_keys(self::$validData);
        $response->assertValid($params);
                
        // Check OK response
        $this->_test_ok($response, 201);
    
        // Check JSON dynamic values
        $response->assertJsonPath("data.id",
            fn ($id) => !empty($id)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;

    }
  
    public function test_post_create_error()
    {
        Sanctum::actingAs(self::$testUser);
        // Cridar servei web de l'API
        $response = $this->postJson("/api/posts", self::$invalidData);

        $params = [
            'body'
        ];
        $response->assertInvalid($params);
        
        // Check ERROR response
        $this->_test_error($response);
        
    }
  
    

    public function test_post_read(object $posts)
    {
        // Read one file
        $response = $this->getJson("/api/posts/{$posts->id}");
        // Check OK response
        $this->_test_ok($response);
       
    }

    public function test_post_read_notfound()
    {
        Sanctum::actingAs(self::$testUser);
        $id = "not_exists";
        $response = $this->getJson("/api/posts/{$id}");
        $this->_test_notfound($response);
    }
       

    public function test_post_update(object $posts)
    {
        Sanctum::actingAs(self::$testUser);
        // Cridar servei web de l'API
        $response = $this->putJson("/api/posts/{$posts->id}", self::$validData);
        // Revisar que no hi ha errors de validació
        $params = array_keys(self::$validData);
        $response->assertValid($params);
                
        // Check OK response
        $this->_test_ok($response, 201);
    
        // Check JSON dynamic values
        $response->assertJsonPath("data.id",
            fn ($id) => !empty($id)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
    }

    public function test_posts_update_error(object $posts)
    {
        Sanctum::actingAs(self::$testUser);
        // Cridar servei web de l'API
        $response = $this->postJson("/api/posts", self::$invalidData);

        $params = [
            'body'
        ];
        $response->assertInvalid($params);
        // Check ERROR response
        $this->_test_error($response);
    }
    
    public function test_post_update_notfound()
    {
        Sanctum::actingAs(self::$testUser);
        $id = "not_exists";
        $response = $this->putJson("/api/posts/{$id}", []);
        $this->_test_notfound($response);
    }

    public function test_post_delete(object $posts)
    {
        Sanctum::actingAs(self::$testUser);
        // Delete one file using API web service
        $response = $this->deleteJson("/api/posts/{$posts->id}");
        // Check OK response
        $this->_test_ok($response);
    }
    
    public function test_post_delete_notfound()
    {
        Sanctum::actingAs(self::$testUser);
        $id = "not_exists";
        $response = $this->deleteJson("/api/posts/{$id}");
        $this->_test_notfound($response);
    }

    /*****************
    * test Like *
    ******************/
    public function test_post_like(object $posts)
    {
        Sanctum::actingAs(self::$testUser);
        $response = $this->postJson("/api/posts/{$posts->id}/likes");
        // Check OK response
        $this->_test_ok($response);
        
    }

    public function test_post_like_error(object $posts)
    {
        Sanctum::actingAs(self::$testUser);
        $response = $this->getJson("/api/posts/{$posts->id}/likes");
        // Check ERROR response
        $this->_test_error($response);
        
    }

    public function test_post_unlike(object $posts)
    {
        Sanctum::actingAs(self::$testUser);
        // Read one file
        $response = $this->getJson("/api/posts/{$posts->id}/like");
        // Check OK response
        $this->_test_ok($response);
        
    }

    public function test_post_unlike_error(object $posts)
    {
        Sanctum::actingAs(self::$testUser);
        $response = $this->getJson("/api/posts/{$posts->id}/like");
        // Check ERROR response
        $this->_test_error($response);
        
    }

    /*****************
    * Tests *
    ******************/

    protected function _test_ok($response, $status = 200)
    {
        // Check JSON response
        $response->assertStatus($status);
        // Check JSON properties
        $response->assertJson([
            "success" => true,
            "data"    => true // any value
        ]);
    }

    protected function _test_error($response)
    {
        // Check response
        $response->assertStatus(422);
        // Check JSON properties
        $response->assertJson([
            "message" => true, // any value
            "errors"  => true, // any value
        ]);       
        // Check JSON dynamic values
        $response->assertJsonPath("message",
            fn ($message) => !empty($message) && is_string($message)
        );
        $response->assertJsonPath("errors",
            fn ($errors) => is_array($errors)
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
        $response->assertJsonPath("message",
            fn ($message) => !empty($message) && is_string($message)
        );   
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