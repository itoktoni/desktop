<?php

namespace App\Listeners;

use App\Dao\Enums\MovementStatus;
use App\Dao\Models\Location;
use App\Dao\Models\Product;
use App\Events\CreateMovementEvent;
use App\Mail\CreateMovementEmail;
use Illuminate\Support\Facades\Mail;
use Plugins\WhatsApp;

class CreateMovementListener
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
    public function handle(CreateMovementEvent $event)
    {
        $report_from = auth()->user() ?? false;
        $report_to = $event->data->has_user ?? false;

        $email_from = $report_from->field_email ?? false;
        $email_to = $report_to->field_email ?? false;

        $phone_from = $report_from->field_phone ?? false;
        $phone_to = $report_to->field_phone ?? false;

        if ($email_to) {
            $product_name = $event->data->has_product->{Product::field_name()} ?? '-';
            $location_old = $event->data->has_location_old->{Location::field_name()} ?? '-';
            $location_new = $event->data->has_location->{Location::field_name()} ?? '-';

            Mail::to([$email_from, $email_to])->send(new CreateMovementEmail($event->data, $product_name, $location_old, $location_new));
        }

        if ($phone_from) {
            $message = MovementStatus::getDescription((int) $event->data->field_status) . '  -  ' . $event->data->field_description;
            WhatsApp::send($phone_from, $message);
        }

    }
}
