<?php
use Laravel\Lumen\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    protected $faker;

     public function setUp()
     {
         parent::setUp();
         $this->faker = Faker::create();
     }

    public function testCreate()
    {
      $this->post('/api/user/create', 
        ['email' => $this->faker->email, 'password' => $this->faker->password])
         ->seeStatusCode(200)
         ->seeJson([
             'message' => "created",
         ]); 
    }

    public function testFind()
    {
      $this->get('/api/user/find/2')
        ->seeStatusCode(200)
         ->seeJsonStructure([
             "id",
             "email",
             "role",
             "last_access",
             "remember_token",
             "date_created",
             "active"
      ]); 
    }

    public function testAll()
    {
      $this->get('/api/user/all')
        ->seeStatusCode(200)
         ->seeJsonStructure([
             ["id",
              "email",
              "role",
              "last_access",
              "remember_token",
              "date_created",
              "active"]
      ]); 
    }

    // public function testDelete()
    // {  
    //   $this->post('/api/user/delete/2')
    //      ->seeStatusCode(200)
    //      ->seeJson([
    //          'message' => "deleted user with id: 2"
    //      ]); 
    // }

}
