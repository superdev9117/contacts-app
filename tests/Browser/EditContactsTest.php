<?php

namespace Tests\Browser;

use App\Contact;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditContactsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testEditContact()
    {
        $this->browse(function (Browser $browser) {

            $user = factory(User::class)->create();
            factory(Contact::class)->create(['image_url'=>'user.jpg','user_id'=>$user->id]);
            $contact = factory(Contact::class)->make();
            $browser->loginAs($user)
                ->visit('/home')
                ->click('.avatar .dropdown-button')
                ->pause(1000)
                ->click('.edit_data_btn')
                ->pause(1000)
                ->type('.user_name_edit', $contact->name)
                ->type('.user_phone_edit', $contact->phone)
                ->type('.user_mail_edit', $contact->email);
            $browser->script(
                [
                    "$('.user_date_edit').val('"
                    .$contact->birthday->toDateString()."')",
                ]
            );
            $browser->attach('#user_image_edit', __DIR__.'/files/user.jpg');
            $browser->click('#submit')
                ->pause(2000)
                ->assertSee($contact->name)
                ->assertSee($contact->phone);
        });
    }
}
