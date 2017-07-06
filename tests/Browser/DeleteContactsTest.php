<?php

namespace Tests\Browser;

use App\Contact;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteContactsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testDeleteContact()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();
            $contact = factory(Contact::class)->create(['user_id'=> $user->id, 'image_url'=>'user.jpg']);
            $browser->loginAs($user)
                    ->visit('/home')
                    ->click('.avatar .dropdown-button')
                    ->pause(1000)
                    ->click('.deleteItem')
                    ->pause(1000)
                    ->click('#deleteButton')
                    ->pause(1000)
                    ->assertDontSee($contact->name);

        });
    }
}
