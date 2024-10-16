<?php

namespace App\Services;

abstract class Service
{

    protected $user = null;


    /**
     * Get data user
     *
     * @param \App\Models\User $user
     *
     * @return $this
     */
    public function withUser($user)
    {
        $this->user = $user;

        return $this;

    }//end withUser()


    /**
     * Create new service instance
     *
     * @return $this
     */
    public static function getInstance()
    {
        return app(static::class);

    }//end getInstance()


}//end class
