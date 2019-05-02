<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Support\Collection;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class CountByTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        $result = $collection->countBy(function () {
            return 'test';
        });

        $this->assertInstanceOf(Collection::class, $result);
    }
}
