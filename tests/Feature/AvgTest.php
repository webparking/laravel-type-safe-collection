<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class AvgTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        $collection->avg(function () {
            return 1;
        });

        $collection->avg('test');

        // FIXME: This errors due to invalid types
//        $collection->avg();
    }
}
