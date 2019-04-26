<?php

namespace Webparking\TypeSafeCollection\Tests\Data;

use Webparking\TypeSafeCollection\Eloquent\TypeSafeCollection;

class CommentCollection extends TypeSafeCollection
{
    protected $type = Comment::class;
}
