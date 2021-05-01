<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self top()
 * @method static self bottom()
 * @method static self social()
 */

final class FooterMenusEnum extends Enum
{
    const MAP_VALUE = [
        'top' => 'top',
        'bottom' => 'bottom',
        'social' => 'social',
    ];
}
