<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use Test\TripServiceKata\User\UserBuilder;
use TripServiceKata\TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\TripServiceKata\Trip\Trip;
use TripServiceKata\TripServiceKata\Trip\TripService;
use TripServiceKata\TripServiceKata\User\User;

class TripServiceTest extends TestCase
{
    /** @var TripService */
    private $tripService;
    /** @var User */
    private $loggedInUser;

    protected function setUp()
    {
        $this->tripService = $this->createMock(TripService::class);
        $this->loggedInUser = new User('John');
    }

    /** @test */
    public function it_should_throw_an_exception_when_user_is_not_logged_and_tries_to_see_the_trip_list() : void
    {
        // EXPECT
        $this->expectException(UserNotLoggedInException::class);

        // GIVEN
        $guest = null;
        $unusedUser = new User("unusedUser");
        $this->tripService->method('getFriendTrips')->willThrowException(new UserNotLoggedInException());


        // WHEN
        $this->tripService->getFriendTrips($unusedUser, $guest);
    }


    /** @test */
    public function it_should_not_return_not_trips_when_is_not_a_friend() : void
    {
        // GIVEN
        $tripToLondon = new Trip();
        $friend = UserBuilder::init()
            ->withName("Jane")
            ->withTrips($tripToLondon)
            ->build();
        $this->tripService->method('getFriendTrips')->willReturn([]);

        // WHEN
        $tripList = $this->tripService->getFriendTrips($friend, $this->loggedInUser);

        // THEN
        $this->assertCount(0, $tripList);
    }


    /** @test */
    public function it_should_return_the_friend_trip_list_when_is_a_friend() : void
    {
        // GIVEN
        $tripToLondon = new Trip();
        $friend = UserBuilder::init()
            ->withName("Jane")
            ->withFriends($this->loggedInUser)
            ->withTrips($tripToLondon)
            ->build();
        $this->tripService->method('getFriendTrips')->willReturn($friend->getTrips());

        // WHEN
        $tripList = $this->tripService->getFriendTrips($friend, $this->loggedInUser);

        // THEN
        $this->assertCount(1, $tripList);
    }
}
