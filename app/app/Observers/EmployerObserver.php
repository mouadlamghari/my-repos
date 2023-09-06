<?php

namespace App\Observers;

use App\Models\Employe;

class EmployerObserver
{
    /**
     * Handle the Roles "created" event.
     */
    public function created(Employe $roles): void
    {
        
    }

    /**
     * Handle the Roles "updated" event.
     */
    public function updated(Employe $roles): void
    {
        //
    }

    /**
     * Handle the Roles "deleted" event.
     */
    public function deleted(Employe $roles): void
    {
        //
    }

    /**
     * Handle the Roles "restored" event.
     */
    public function restored(Employe $roles): void
    {
        //
    }

    /**
     * Handle the Roles "force deleted" event.
     */
    public function forceDeleted(Employe $roles): void
    {
        //
    }
}
