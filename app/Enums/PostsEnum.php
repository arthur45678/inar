<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self article()
 * @method static self news()
 * @method static self events()
 * @method static self pagesPosts()
 * @method static self press_releases()
 */

final class PostsEnum extends Enum
{
    const MAP_VALUE = [
        'article' => 'article',
        'news' => 'news',
        'events' => 'events',
        'pages-posts' => 'pages-posts',
        'press_releases' => 'press_releases'
    ];
}
