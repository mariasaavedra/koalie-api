<?php

use Illuminate\Database\Seeder;
use App\Event;
use Carbon\Carbon;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $openspaceskc = new Event();
        $openspaceskc->title = '#openspaceskc';
        $openspaceskc->length = 168; // hours
        $openspaceskc->admin_id = 1;
        $openspaceskc->attachment_url = "default";
        $openspaceskc->public = true;
        $openspaceskc->date_start = Carbon::parse('2018-11-13 12:00:00');
        $openspaceskc->date_end = Carbon::parse('2018-11-18 12:00:00');
        $openspaceskc->slot_num = 5;
        $openspaceskc->save();

        $tikicat = new Event();
        $tikicat->title = '#tikicat';
        $tikicat->length = 168; // hours
        $tikicat->admin_id = 1;
        $tikicat->attachment_url = "default";
        $tikicat->public = true;
        $tikicat->date_start = Carbon::parse('2018-11-15 12:00:00');
        $tikicat->date_end = Carbon::parse('2018-11-30 12:00:00');
        $tikicat->slot_num = 5;
        $tikicat->save();

    }

}
