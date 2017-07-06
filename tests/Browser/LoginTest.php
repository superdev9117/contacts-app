<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {

            $user = factory(User::class)->create();

            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password','secret')
                    ->press('LOGIN')
                    ->pause(1000)
                    ->assertPathIs('/home');
        });
    }

}
