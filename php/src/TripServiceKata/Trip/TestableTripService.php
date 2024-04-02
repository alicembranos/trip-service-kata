<?php

namespace TripServiceKata\TripServiceKata\Trip;

use TripServiceKata\TripServiceKata\User\User;

class TestableTripService extends TripService
{
    /** @return array<Trip> */
    protected function findTripsByUser(User $user) : array
    {
        return $user->getTrips();
    }
}
