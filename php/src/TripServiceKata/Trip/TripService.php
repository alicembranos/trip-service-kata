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
    public function getTripsByUser(User $user, ?User $loggedInUser)
    {
        if ($loggedInUser == null) {
            throw new UserNotLoggedInException();
        }
        return $user->isFriendWith($loggedInUser) ? $this->findTripsByUser($user) : $this->noTrips();
    }

    /**
     * @param User $user
     * @return Array<Trip>
     */
    protected function findTripsByUser(User $user)
    {
        return TripDAO::findTripsByUser($user);
    }

    /** @return array */
    private function noTrips()
    {
        return array();
    }
}
