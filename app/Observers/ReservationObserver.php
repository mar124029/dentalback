<?php

namespace App\Observers;

use App\Enums\Status;
use App\Models\Reservation;
use App\Traits\ReservaHelpers\HandlesReservationEmails;

class ReservationObserver
{
    use HandlesReservationEmails;

    public function updated(Reservation $reservation)
    {
        if ($reservation->wasChanged('status') && $reservation->status === Status::DELETED->value) {
            $this->sendReservationMail($reservation->id, 'cancelled');
            return;
        }

        if ($reservation->wasChanged('is_confirmed') && $reservation->is_confirmed) {
            $this->sendReservationMail($reservation->id, 'confirmed');
            return;
        }

        if ($reservation->wasChanged('is_paid') && $reservation->is_paid) {
            $this->sendReservationMail($reservation->id, 'paid');
            return;
        }

        if ($reservation->wasChanged('is_attended') && $reservation->is_attended) {
            $this->sendReservationMail($reservation->id, 'attended');
            return;
        }

        if ($reservation->wasChanged('is_rescheduled') && $reservation->is_rescheduled) {
            $this->sendReservationMail($reservation->id, 'rescheduled');
            return;
        }
    }
}
