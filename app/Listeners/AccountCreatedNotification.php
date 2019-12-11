<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use App\Jobs\ImportQiita;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AccountCreated $event)
    {
    	$data = $event->data;

		ImportQiita::dispatchNow($data);
	}
}
