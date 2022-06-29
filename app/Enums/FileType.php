<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FileType extends Enum
{
    const OptionOne = 'contract';
    const OptionTwo = 'Main person documents';
    const OptionThree = 'Spouse documents';
    const OptionFour = 'Children documents';
    const OptionFive = 'Insurance documents';
    const OptionSix = 'Home documents';
    const OptionSeven = 'Financial documents';
    const OptionEight = 'Other documents';
}
