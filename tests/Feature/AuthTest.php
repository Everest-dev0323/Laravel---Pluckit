<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * @test
     * check whether the root url is working or not
     */

    public function it_checks_main_url_working()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // check login using browser dusk
    public function check_login_working(){
        $user = factory(User::class)->create([
            'email' => 'shiv@gmail.com'
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Login')
                ->assertPathIs('/home');
        });
    }

    // check multiple logins
    public function check_multiple_login_instances(){
        //login as first user
        $this->browse(function ($first, $second) {
            $first->loginAs(User::find(1))
                ->visit('/home')
                ->waitForText('logged in successfully');
            // logged in as second user
            $second->loginAs(User::find(2))
                ->visit('/home')
                ->waitForText('logged in successfully');
        });
    }
}
