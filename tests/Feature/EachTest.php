<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class EachTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        $collection->each(function (User $user) {
        });
    }
}
