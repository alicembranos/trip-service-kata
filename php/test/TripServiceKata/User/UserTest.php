<?php

namespace Test\TripServiceKata\User;

use TripServiceKata\TripServiceKata\User\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_should_inform_when_users_are_not_friends() : void
    {
        // GIVEN
        $user = UserBuilder::init()
                    ->withName('Jane')
                    ->withFriends(new User('John'))
                    ->build();

        // WHEN
        $isFriend = $user->isFriendWith(new User('Alice'));

        // THEN
        $this->assertFalse($isFriend);
    }

    /** @test */
    public function it_should_inform_when_users_are_friends() : void
    {
        // GIVEN
        $user = UserBuilder::init()
            ->withName('Jane')
            ->withFriends(new User('John'))
            ->build();

        // WHEN
        $isFriend = $user->isFriendWith(new User('John'));

        // THEN
        $this->assertTrue($isFriend);
    }

}
