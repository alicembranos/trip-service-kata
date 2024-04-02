<?php

namespace TripServiceKata\TripServiceKata\Trip;

use TripServiceKata\TripServiceKata\User\User;
use TripServiceKata\TripServiceKata\User\UserSession;
use TripServiceKata\TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    /**
     * @return array<Trip>
     * @throws UserNotLoggedInException
     */
    public function getTripsByUser(User $user)
    {
        if ($this->getLoggedUser() == null) {
            throw new UserNotLoggedInException();
        }
        return $user->isFriendWith($this->getLoggedUser()) ? $this->findTripsByUser($user) : $this->noTrips();
    }

    /** @return User */
    protected function getLoggedUser()
    {
        return UserSession::getInstance()->getLoggedUser();
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
