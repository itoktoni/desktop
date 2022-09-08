<?php

namespace App\Dao\Enums;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Enum as Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

class WorkType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    const Preventif                  = env('WORK_TYPE_PREVENTIF');
    const Korektif                  =  2;
    const Penjadwalan              =  3;
    const Kalibrasi              =  4;
}
