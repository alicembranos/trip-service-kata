<?php

namespace Test\TripServiceKata;

use TripServiceKata\TripServiceKata\Trip\Trip;
use TripServiceKata\TripServiceKata\User\User;

class UserBuilder
{
    /** @var User[] */
    private $friends = [];
    /** @var Trip[] */
    private $trips = [];
    /** @var string */
    private $name;

    /** @return self */
    public static function init()
    {
        return new self();
    }


    /** @param string $name */
    public function withName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function withFriends(User ...$friends)
    {
        $this->friends = $friends;

        return $this;
    }

    public function withTrips(Trip ...$trips)
    {
        $this->trips = $trips;

        return $this;
    }

    public function build()
    {
        $user = new User($this->name);
        $this->addFriendsTo($user);
        $this->addTripsTo($user);
        return $user;
    }

    /** @return void */
    private function addFriendsTo(User $user)
    {
        foreach ($this->friends as $friend) {
            $user->addFriend($friend);
        }
    }

    /** @return void */
    private function addTripsTo(User $user)
    {
        foreach ($this->trips as $trip) {
            $user->addTrip($trip);
        }
    }
}
