<?php


/*
| -------------------------------------------------------------------------
| L2T Framework
| -------------------------------------------------------------------------
|
| User: spatel
| Date: 26/09/18
| Time: 10:05 AM
| Version: 1.0
| Website: http://www.phpcodebooster.com
*/

namespace L2T\Providers;

use Illuminate\Auth\EloquentUserProvider;

class UserServiceProvider extends EloquentUserProvider {

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        return \Cache::remember(env('DB_CONNECTION') .'-user-'.$identifier, 5, function() use ($identifier) {
            return $this->createModel()->newQuery()->find($identifier);
        });
    }
}