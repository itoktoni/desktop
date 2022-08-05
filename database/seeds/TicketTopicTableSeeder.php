<?php

use App\Dao\Models\TicketTopic;
use App\Dao\Models\WorkType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketTopicTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */

    public $model;

    public function __construct(TicketTopic $model)
    {
        $this->model = $model;
    }

    public function run()
    {
        $this->model->delete();
        $this->model->insert(array (
            [
                'ticket_topic_id' => 1,
                'ticket_topic_name' => 'Alat Rusak',
                'ticket_topic_active' => 1,
            ],
            [
                'ticket_topic_id' => 2,
                'ticket_topic_name' => 'Training Alat',
                'ticket_topic_active' => 1,
            ],
            [
                'ticket_topic_id' => 3,
                'ticket_topic_name' => 'Penggantian Alat',
                'ticket_topic_active' => 1,
            ],
        ));
    }
}