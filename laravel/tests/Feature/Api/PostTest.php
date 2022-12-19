<?php

namespace Tests\Feature;
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
            'body' => 'hola mon',
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
        $response = $this->postJson("/api/post", self::$validData);
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
        $response = $this->postJson("/api/post", self::$invalidData);
        // TODO Revisar errors de validació
        $params = [
            'body', 'body',
            'upload' => $upload,
            'latitude'    => 'latitude',
            'longitude'   => 'longitude',
            'visibility_id'   => '1',
        ];
        $response->assertInvalid($params);
        // TODO Revisar més errors

        
    }
  
    // TODO Sub-tests de totes les operacions CRUD
  
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
 

    
