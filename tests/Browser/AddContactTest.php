<?php

namespace Tests\Browser;

use App\Contact;
use App\User;
use Carbon\Carbon;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddContactTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAddContact()
    {
        $this->browse(function (Browser $browser) {

            $user = factory(User::class)->create();

            $contact = factory(Contact::class)->make();

            $browser->loginAs($user)
            ->visit('/home')
            ->click('#menu')
            ->pause(1000)
            ->type('name', $contact->name)
            ->type('email', $contact->email)
            ->type('phone', $contact->phone);
            $browser->script(
                [
                    "$('input[name=birthday]').val('"
                    .$contact->birthday->toDateString()."')",
                ]
            );

            $browser->attach('image', __DIR__.'/files/user.jpg')
            ->click('#btn_append')
            ->pause(1000)
            ->assertSee($contact->name)
            ->assertSee($contact->phone);

        });
    }
}
