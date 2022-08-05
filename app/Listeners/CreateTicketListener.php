<?php

namespace App\Listeners;

use App\Events\CreateTicketEvent;
use App\Mail\CreateTicketEmail;
use App\Mail\TicketCreatedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
        $report_from = $event->data->has_reported->field_email ?? false;
        $report_to = $event->data->has_department->has_user->field_email ?? false;

        if($report_to){
            Mail::to([$report_from, $report_to])->send(new CreateTicketEmail($event));
        }
    }
}
