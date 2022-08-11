<?php

namespace App\Listeners;

use App\Events\CreateWorkSheetEvent;
use App\Mail\CreateWorkSheetEmail;
use Illuminate\Support\Facades\Mail;

class CreateWorkSheetListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreateWorkSheetEvent $event)
    {
        dd($event->data);
        //   $report_from = $event->data->has_reported->field_email ?? false;
        //   $report_to = $event->data->has_department->has_user->field_email ?? false;

        $report_from = 'admin@demo.com';
        $report_to = 'hartati.zulaikha@yahoo.co.id';

        if ($report_to) {
            Mail::to([$report_from, $report_to])->send(new CreateWorkSheetEmail($event->data));
        }
    }
}
