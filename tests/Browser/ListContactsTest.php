<?php

namespace Tests\Browser;

use App\Contact;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListContactsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testListContacts()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();
            $contacts = factory(Contact::class, 10)->create(['user_id'=>$user->id,
                'image_url'=>'user.jpg']);

            $browser->loginAs($user)
                ->visit('/home');

            $contacts->each(function ($item) use ($browser){
                $browser->assertSee($item->name);
            });

        });
    }
}
