<?php

namespace Test\TripServiceKata\User;

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

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withFriends(User ...$friends): self
    {
        $this->friends = $friends;

        return $this;
    }

    public function withTrips(Trip ...$trips): self
    {
        $this->trips = $trips;

        return $this;
    }

    public function build(): User
    {
        $user = new User($this->name);
        $this->addFriendsTo($user);
        $this->addTripsTo($user);
        return $user;
    }

    private function addFriendsTo(User $user): void
    {
        foreach ($this->friends as $friend) {
            $user->addFriend($friend);
        }
    }

    private function addTripsTo(User $user): void
    {
        foreach ($this->trips as $trip) {
            $user->addTrip($trip);
        }
    }
}
