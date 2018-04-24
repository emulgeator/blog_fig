<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class BlogPost extends Model
{
    const STATUS_NEW        = 'new';
    const STATUS_PUBLISHED  = 'published';
    const STATUS_DELETED    = 'deleted';

    protected $connection = 'mongodb';

    protected $fillable = [
        'status',
        'title',
        'lead',
        'body',
    ];

    public static function getValidStatuses(): array
    {
        return [
            self::STATUS_NEW,
            self::STATUS_PUBLISHED,
            self::STATUS_DELETED
        ];
    }
}
