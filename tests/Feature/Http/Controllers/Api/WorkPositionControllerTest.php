<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\WorkPosition;
use App\User;


class WorkPositionControllerTest extends TestCase
{

    use RefreshDatabase;

    //Prueba unitaria para el metodo store de PostController
    public function test_store()
    {
    //Para el correcto funcionamiento con seguridad debo loguear un usuario:
        $user = factory(User::class)->create();

        //Visualizar rapidamente los errores especificos
        // $this->withoutExceptionHandling();

        //Estamos ingresando a esta ruta como un usuario logueado:
        //Este logueo se hace mediante un token "actingAs($user, 'api')"
        $response = $this->actingAs($user, 'api')->json('POST', '/api/workposition', [
            'name' => 'nametest'
        ]);

        $response->assertJsonStructure(['id', 'name', 'created_at', 'updated_at'])
            ->assertJson(['name' => 'nametest'])
            ->assertStatus(201); //ok, creando un recurso

        $this->assertDatabaseHas('work_positions', ['name' => 'nametest']);
    }

    //Prueba unitaria para el titulo de Post
    public function test_validate_name()
    {
        // $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')->json('POST', '/api/workposition', [
            'name' => ''
        ]);

        //La solicitud esta echa pero fue imposible completarla
        $response->assertStatus(422) 
            ->assertJsonValidationErrors('name');


    }

    //Prueba unitaria para el show de PostController
    public function test_show()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        //Debemos hacer la creación de un post atravez de un factory
        $workposition = factory(WorkPosition::class)->create();

        //De esta manera accedemos al post que cremos con factory.
        $response = $this->actingAs($user, 'api')->json('GET', "/api/workposition/$workposition->id"); //id=1

        $response->assertJsonStructure(['id', 'name', 'created_at', 'updated_at'])
        ->assertJson(['name' => $workposition->name])
        ->assertStatus(200); //Acceso correcto
    }

    //Prueba unitaria para verificar la existencia de un post
    public function test_404_show()
    {
        $user = factory(User::class)->create();

        //De esta manera intentamos acceder al post numero 100000, que no existe.
        $response = $this->actingAs($user, 'api')->json('GET', '/api/workposition/100000'); //id=1

        $response->assertStatus(404);
    }

    //Prueba unitaria para el metodo update de WorkPositionController
    //para esta prueba en especifico debemos crear un workposition y luego probar
    public function test_update()
    {
        $user = factory(User::class)->create();

        //Visualizar rapidamente los errores especificos
        //$this->withoutExceptionHandling();

        //Debemos hacer la creación de un workposition atravez de un factory
        $workposition = factory(WorkPosition::class)->create();

        $response = $this->actingAs($user, 'api')->json('PUT', "/api/workposition/$workposition->id", [
            'name' => 'new'
        ]);
            //comprobamos si en la base de datos existe el campo con el dato.
        $response->assertJsonStructure(['id', 'name', 'created_at', 'updated_at'])
            ->assertJson(['name' => 'new'])
            ->assertStatus(200); //ok
            //comprobamos si en la base de datos existe el campo con el dato.
        $this->assertDatabaseHas('work_positions', ['name' => 'new']);
    }

    //Prueba unitaria para el metodo DESTROY de WorkPositionController
    //para esta prueba en especifico debemos crear un workposition y luego probar
    public function test_destroy()
    {

        $user = factory(User::class)->create();

        //Visualizar rapidamente los errores especificos
        //$this->withoutExceptionHandling();

        //Debemos hacer la creación de un workposition atravez de un factory
        $workposition = factory(WorkPosition::class)->create();

        $response = $this->actingAs($user, 'api')->json('DELETE', "/api/workposition/$workposition->id");

        $response->assertSee(null)
            ->assertStatus(204); //Sin contenido

        $this->assertDatabaseMissing('work_positions', ['id' => $workposition->id]);
    }

    //Prueba unitaria para renderizado de información.
    public function test_index()
    {

        $user = factory(User::class)->create();

        //Visualizar rapidamente los errores especificos
        // $this->withoutExceptionHandling();

        //GENERAMOS REGISTROS PARA OBSERVAR QUE ESTOY RESIVIENDO DESDE EL CLIENTE
        factory(WorkPosition::class, 5)->create();

        //Accedemos a la ruta
        $response = $this->actingAs($user, 'api')->json('GET', '/api/workposition');
        
        //Verificamos la estructura en JSON
        $response->assertJsonStructure([
            'data' => [
                //Verificamos que estamos resiviendo muchos datos, y que estos tienen la estructura de post
                '*'=> ['id', 'name', 'created_at', 'updated_at']
                ]
            
            ])->assertStatus(200); //ok
    }

    //Prueb unitaria para autenticación:
    public function test_guest(){

    //Verificación de metodos HTTP:
        
        //Verificación de estatus 401, acceso no autorizado:
        $this->json('GET', '/api/workposition')->assertStatus(401);
        $this->json('POST', '/api/workposition')->assertStatus(401);
        $this->json('GET', '/api/workposition/100000')->assertStatus(401);
        $this->json('PUT', '/api/workposition/100000')->assertStatus(401);
        $this->json('DELETE', '/api/workposition/100000')->assertStatus(401);
    }
}
