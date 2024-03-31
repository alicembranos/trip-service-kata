<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;

class TestableTripService extends TripService
{
    /** @var User */
    private $loggedUser;

    public function __construct(User $user = null)
    {
        $this->loggedUser = $user;
    }

    /** @return User */
    protected function getLoggedUser()
    {
        return $this->loggedUser;
    }

    /**
     * @param User $user
     * @return array<Trip>
     */
    protected function findTripsByUser(User $user)
    {
        return $user->getTrips();
    }
}
