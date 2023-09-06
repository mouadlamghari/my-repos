<?php

namespace App\Observers;

use App\Models\Roles;

class UserObserver
{
    /**
     * Handle the Roles "created" event.
     */
    public function created(Roles $roles): void
    {
        //
    }

    /**
     * Handle the Roles "updated" event.
     */
    public function updated(Roles $roles): void
    {
        //
    }

    /**
     * Handle the Roles "deleted" event.
     */
    public function deleted(Roles $roles): void
    {
        //
    }

    /**
     * Handle the Roles "restored" event.
     */
    public function restored(Roles $roles): void
    {
        //
    }

    /**
     * Handle the Roles "force deleted" event.
     */
    public function forceDeleted(Roles $roles): void
    {
        //
    }
}
