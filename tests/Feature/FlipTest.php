<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class FlipTest extends TestCase
{
    /**
     * @expectedException \Webparking\TypeSafeCollection\Exceptions\InvalidOperationException
     */
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        $collection->flip();
    }
}
