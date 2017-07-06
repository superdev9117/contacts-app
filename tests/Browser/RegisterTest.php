<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {

            $user = factory(User::class)->make();

            $browser->visit('/login')
                ->click('.close')
                ->pause(1000)
                ->type('name', $user->name)
                ->type('#email_reg', $user->email)
                ->type('#paaword_reg','secret')
                ->press('REGISTER')
                ->pause(1000)
                ->assertPathIs('/home');
        });
    }
}
