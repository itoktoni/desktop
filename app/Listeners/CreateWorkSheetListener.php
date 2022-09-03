<?php

namespace App\Listeners;

use App\Dao\Models\User;
use App\Events\CreateWorkSheetEvent;
use App\Mail\CreateWorkSheetEmail;
use Illuminate\Support\Facades\Mail;
use Plugins\WhatsApp;

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
        $report_from = auth()->user() ?? false;
        $report_to = $event->data->has_reported_by ?? false;

        $email_from = $report_from->field_email ?? false;
        $email_to = $report_to->field_email ?? false;

        $phone_from = $report_from->field_phone ?? false;
        $phone_to = $report_to->field_phone ?? false;

        if ($email_to) {
            $type = $event->data->has_work_type->field_name ?? '';
            Mail::to([$email_from, $email_to])->send(new CreateWorkSheetEmail($event->data, $type));
        }

        if ($phone_from) {
            $message = "*ID : " . $event->data->field_primary .
            "*\nReported By : " . $report_from->field_name .
            "\nDeskripsi    : " . $event->data->field_description .
            "\nCheck        : " . $event->data->field_check .
            "\nResult       : " . $event->data->field_result;

            WhatsApp::send($phone_from, $message);
        }

    }
}
