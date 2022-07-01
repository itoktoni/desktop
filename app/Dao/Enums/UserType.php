<?php

namespace App\Dao\Enums;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Enum as Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

class UserType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    const Type                  =  null;
    const Active               =  1;
    const NonActive            =  2;

    public static function colors()
    {
        return [
            self::Type => ColorType::Primary,
            self::Active => ColorType::Danger,
            self::NonActive => ColorType::Danger,
        ];
    }

    public static function getDescription($value): string
    {
        if ($value === self::Type) {
            return '- Pilih Type -';
        }

        return parent::getDescription($value);
    }

    public static function name()
    {
        return 'Category Type';
    }
}
