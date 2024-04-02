<?php

namespace TripServiceKata\TripServiceKata\Trip;

use TripServiceKata\TripServiceKata\User\User;

class TestableTripService extends TripService
{
    /** @var User */
    private $loggedUser;

    public function __construct(User $user = null)
    {
        $this->loggedUser = $user;
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
