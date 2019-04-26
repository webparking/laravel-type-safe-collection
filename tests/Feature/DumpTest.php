<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class DumpTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testCorrect(): void
    {
        (new UserCollection())->dump();
    }
}
