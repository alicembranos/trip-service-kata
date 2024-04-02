<?php

namespace TripServiceKata\TripServiceKata\User;

use TripServiceKata\TripServiceKata\Trip\Trip;

class User
{
    private $trips;
    private $friends;
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
        $this->trips = array();
        $this->friends = array();
    }

    /** @return array<Trip> */
    public function getTrips()
    {
        return $this->trips;
    }

    /** @return array<User> */
    public function getFriends()
    {
        return $this->friends;
    }

    /** @return void */
    public function addFriend(User $user)
    {
        $this->friends[] = $user;
    }

    /** @return void */
    public function addTrip(Trip $trip)
    {
        $this->trips[] = $trip;
    }

    /** @return bool */
    public function isFriendWith(User $friend)
    {
        return in_array($friend, $this->friends);
    }
}
