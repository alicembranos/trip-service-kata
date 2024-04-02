<?php

namespace TripServiceKata\TripServiceKata\Trip;

use TripServiceKata\TripServiceKata\User\User;
use TripServiceKata\TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    /**
     * @return array<Trip>
     * @throws UserNotLoggedInException
     */
    public function getTripsByUser(User $user, ?User $loggedInUser) : array
    {
        if ($loggedInUser == null) {
            throw new UserNotLoggedInException();
        }
        return $user->isFriendWith($loggedInUser) ? $this->findTripsByUser($user) : $this->noTrips();
    }

    /** @return Array<Trip> */
    protected function findTripsByUser(User $user) : array
    {
        return TripDAO::findTripsByUser($user);
    }

    private function noTrips() : array
    {
        return array();
    }
}
