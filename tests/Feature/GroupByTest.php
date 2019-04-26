<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Support\Collection;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class GroupByTest extends TestCase
{
    public function testCorrectWithClosure(): void
    {
        $result = (new UserCollection([
            new User(),
            new User(),
        ]))->groupBy(function () {
            return 'test';
        });

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testCorrectWithKey(): void
    {
        $result = (new UserCollection([
            new User(),
            new User(),
        ]))->groupBy('test');

        $this->assertInstanceOf(Collection::class, $result);
    }
}
