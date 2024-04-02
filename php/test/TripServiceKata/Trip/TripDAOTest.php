<?php

namespace Test\TripServiceKata\Trip;

use TripServiceKata\TripServiceKata\Exception\DependentClassCalledDuringUnitTestException;
use TripServiceKata\TripServiceKata\Trip\TripDAO;
use PHPUnit\Framework\TestCase;
use TripServiceKata\TripServiceKata\User\User;

class TripDAOTest extends TestCase
{
    /** @test */
    public function it_throw_exception_when_retrieving_user_trips() : void
    {
        // EXPECT
        $this->expectException(DependentClassCalledDuringUnitTestException::class);

        // WHEN
        $tripDAO = new TripDAO();
        $tripDAO->getTripsBy(new User('loggedInUser'));
    }

}
