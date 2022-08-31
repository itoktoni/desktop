<?php

namespace App\Listeners;

use App\Events\CreateTicketEvent;
use App\Mail\CreateTicketEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Plugins\WhatsApp;

class CreateTicketListener
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
    public function handle(CreateTicketEvent $event)
    {
        $report_from = $event->data->has_reported ?? false;
        $report_to = $event->data->has_department->has_user ?? false;

        $email_from = $report_from->field_email ?? false;
        $email_to = $report_to->field_email ?? false;

        $phone_from = $report_from->field_phone ?? false;
        $phone_to = $report_to->field_phone ?? false;

        if($email_from){
            Mail::to([$report_from, $report_to])->send(new CreateTicketEmail($event->data));
        }

        if($phone_from){
            WhatsApp::send($phone_from, $event->data->field_description);
        }
    }
}
