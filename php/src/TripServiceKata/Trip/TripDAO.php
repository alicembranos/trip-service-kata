<?php

namespace TripServiceKata\TripServiceKata\Trip;

use TripServiceKata\TripServiceKata\User\User;
use TripServiceKata\TripServiceKata\Exception\DependentClassCalledDuringUnitTestException;

class TripDAO
{
    public static function findTripsByUser(User $user)
    {
        throw new DependentClassCalledDuringUnitTestException('TripDAO should not be invoked on an unit test.');
    }
}
