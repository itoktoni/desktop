<?php

use App\Dao\Models\TicketTopic;
use Illuminate\Database\Seeder;

class TicketTopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TicketTopic::class, 5)->create();
    }
}
