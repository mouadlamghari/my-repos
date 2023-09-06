<?php

namespace App\Observers;

use App\Models\Consultation;

class ConsultationObserver
{
    /**
     * Handle the Roles "created" event.
     */
    public function created(Consultation $consultation): void
    {
         $user = request()->user();
        $role = $user->role->name;
        $consultation->log()->create(['message'=>"Consultation $consultation->id est cree par  $user->id  - $user->name - $role ",'user_id'=>$user->id]);
    }

    /**F
     * Handle the consultation "updated" event.
     */
    public function updated(Consultation $consultation): void
    {
        $user = request()->user();
        $role = $user->role->name;
        $consultation->log()->create(['message'=>"Consultation $consultation->id est modifier par  $user->id  - $user->name - $role ",'user_id'=>$user->id]);
    }

    /**
     * Handle the consultation "deleted" event.
     */
    public function deleted(Consultation $consultation): void
    {
        //
    }

    /**
     * Handle the consultation "restored" event.
     */
    public function restored(Consultation $consultation): void
    {
        //
    }

    /**
     * Handle the consultation "force deleted" event.
     */
    public function forceDeleted(Consultation $consultation): void
    {
        //
    }
}
