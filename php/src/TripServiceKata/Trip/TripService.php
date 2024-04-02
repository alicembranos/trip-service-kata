<?php

namespace TripServiceKata\TripServiceKata\Trip;

use TripServiceKata\TripServiceKata\User\User;
use TripServiceKata\TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    /** @var TripDAO */
    private $tripDAO;

    public function __construct(TripDAO $tripDAO)
    {
        $this->tripDAO = $tripDAO;
    }

    /**
     * @return array<Trip>
     * @throws UserNotLoggedInException
     */
    public function getFriendTrips(User $friend, ?User $loggedInUser): array
    {
        $this->validate($loggedInUser);
        return $friend->isFriendWith($loggedInUser) ? $this->findTripsByUser($friend) : $this->noTrips();
    }

    /** @throws UserNotLoggedInException */
    private function validate(?User $loggedInUser): void
    {
        if ($loggedInUser == null) {
            throw new UserNotLoggedInException();
        }
    }

    /** @return Array<Trip> */
    protected function findTripsByUser(User $user): array
    {
        return $this->tripDAO->getTripsBy($user);
    }

    private function noTrips(): array
    {
        return array();
    }
}
