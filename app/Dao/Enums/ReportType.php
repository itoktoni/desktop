<?php

namespace App\Dao\Enums;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Enum as Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

class ReportType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    const Type      =  null;
    const Pdf       =  1;
    const Html      =  2;

    public static function colors()
    {
        return [
            self::Type => ColorType::Primary,
            self::Pdf => ColorType::Danger,
            self::Html => ColorType::Danger,
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
