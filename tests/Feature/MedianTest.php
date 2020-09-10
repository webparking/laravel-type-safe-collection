<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Foundation\Application;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class MedianTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        /* @phpstan-ignore-next-line */
        $collection->median('test');

        // This breaks < 5.7
        /* @phpstan-ignore-next-line */
        if (version_compare(Application::VERSION, '5.7', '>=')) {
            $collection->median();
        }
    }
}
