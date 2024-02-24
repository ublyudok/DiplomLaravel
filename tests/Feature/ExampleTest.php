<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\UserController;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase {
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/'); //Путь, где будем проводить сам тест, а теперь осталось скачать саму разметку

        $response->assertStatus(200); //Всё работает
    }


    public function testget_user() {

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testlogin(){

        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testanotherLogin(){

        $response = $this->get('/loginUser');
        $response->assertStatus(405);
    }

    public function testEmail() {
        $email = DB::table('users')->select('email')->where('email', 'email')->exists();
        $response = $this->get('/loginUser');
        $response->assertStatus(405);
    }

    public function testmedia() {

        $response = $this->get('/media/2');
        $response->assertStatus(200);
    }

    public function testsecurity() {

        $response = $this->get('/security/2');
        $response->assertStatus(200);
    }

    public function testedit() {

        $response = $this->get('/edit/2');
        $response->assertStatus(200);
    }

    public function teststatus() {

        $response = $this->get('/status/2');
        $response->assertStatus(200);
    }

    public function testusers() {

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testLogout() {
        $response = $this->get('/logout');
        $response->assertStatus(302);
    }

    public function testStatusEdit() {

        $response = $this->get('/ReStatus/2');
        $response->assertStatus(405);
    }

    public function testedituser() {

        $response = $this->get('/ReMail/2');
        $response->assertStatus(405);
    }

    public function testcreate() {

        $response = $this->get('/create');
        $response->assertStatus(302);
    }


}