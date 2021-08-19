<?php

namespace App\Models\Passport;
use Laravel\Passport\Client as BaseClient;

class Client extends BaseClient
{
    /**
     * Determine if the client should skip the authorization prompt.
     *
     * @return bool
     */
    public function skipsAuthorization()
    {
        // return $this->firstParty();

        /**
         * TODO: didn't figure out how to set the firstParty to true yet.
         * Because we do only have our own frontend applications connecting to our OAuth server
         * at the moment, so return `true` for skipping the authorization prompt.
         */
        return true;
    }
}
