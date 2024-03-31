<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\TestableTripService;
use TripServiceKata\Trip\Trip;
use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;

class TripServiceTest extends TestCase
{
    /** @var TestableTripService */
    private $tripService;
    /** @var User */
    private $loggedInUser;

    protected function setUp()
    {
        $this->loggedInUser = new User('John');
        $this->tripService = new TestableTripService($this->loggedInUser);
    }

    /** @test */
    public function it_should_throw_an_exception_when_user_is_not_logged_and_tries_to_see_the_trip_list()
    {
        // EXPECT
        $this->expectException(UserNotLoggedInException::class);

        // GIVEN
        $guest = null;
        $this->tripService = new TestableTripService($guest);
        $unusedUser = new User("unusedUser");

        // WHEN
        $this->tripService->getTripsByUser($unusedUser);
    }


    /** @test */
    public function it_should_not_return_the_friends_trip_list_when_is_not_a_friend()
    {
        // GIVEN
        $userFriend = new User('Jane');
        $userFriendTrip = new Trip();
        $userFriend->addTrip($userFriendTrip);

        // WHEN
        $tripList = $this->tripService->getTripsByUser($userFriend);

        // THEN
        $this->assertCount(0, $tripList);
    }


    /** @test */
    public function it_should_return_the_friend_trip_list_when_is_a_friend()
    {
        // GIVEN
        $userFriend = new User('Jane');
        $userFriendTrip = new Trip();
        $userFriend->addTrip($userFriendTrip);
        $userFriend->addFriend($this->loggedInUser);

        // WHEN
        $tripList = $this->tripService->getTripsByUser($userFriend);

        // THEN
        $this->assertCount(1, $tripList);
    }
}
