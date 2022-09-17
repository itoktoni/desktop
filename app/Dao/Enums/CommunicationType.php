<?php

namespace App\Dao\Enums;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Enum as Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

class communicationType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    const Ticket               =  1;
    const Worksheet            =  2;
}
