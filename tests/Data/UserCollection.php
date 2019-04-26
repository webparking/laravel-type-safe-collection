<?php

namespace Webparking\TypeSafeCollection\Tests\Data;

use Webparking\TypeSafeCollection\Eloquent\TypeSafeCollection;

class UserCollection extends TypeSafeCollection
{
    protected $type = User::class;
}
