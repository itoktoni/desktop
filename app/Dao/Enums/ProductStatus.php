<?php

namespace App\Dao\Enums;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Enum as Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

class ProductStatus extends Enum implements LocalizedEnum
{
    use StatusTrait;

    const Status        =  null;
    const Good          =  1;
    const Critical      =  2;
    const Defect        =  3;

    public static function colors()
    {
        return [
            self::Status => ColorType::Primary,
            self::Good => ColorType::Danger,
            self::Critical => ColorType::Danger,
            self::Defect => ColorType::Danger,
        ];
    }

    public static function getDescription($value): string
    {
        if ($value === self::Status) {
            return '- Pilih Status -';
        }

        return parent::getDescription($value);
    }

    public static function name()
    {
        return 'Category Status';
    }
}
