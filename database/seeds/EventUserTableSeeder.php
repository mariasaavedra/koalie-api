<?php

use Illuminate\Database\Seeder;
use App\Event;
use App\User;

class EventUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $event = Event::find(1);
        $event->users()->save($user);

        $user = User::find(1);
        $event = Event::find(2);
        $event->users()->save($user);
    }
}
