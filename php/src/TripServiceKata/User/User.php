<?php

namespace TripServiceKata\TripServiceKata\User;

use TripServiceKata\TripServiceKata\Trip\Trip;

class User
{
    private $trips;
    private $friends;
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->trips = array();
        $this->friends = array();
    }

    /** @return array<Trip> */
    public function getTrips() : array
    {
        return $this->trips;
    }

    /** @return array<User> */
    public function getFriends() : array
    {
        return $this->friends;
    }

    public function addFriend(User $user) : void
    {
        $this->friends[] = $user;
    }

    public function addTrip(Trip $trip) : void
    {
        $this->trips[] = $trip;
    }

    public function isFriendWith(User $friend) : bool
    {
        return in_array($friend, $this->friends);
    }
}
