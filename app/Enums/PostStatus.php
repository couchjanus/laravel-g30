<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PostStatus extends Enum
{
    const Active = 0;
    const Blocked = 1;
    const Panding = 2;
}
