<?php

namespace App\Dao\Traits;

use Illuminate\Support\Collection;
use Modules\System\Plugins\Filter;

trait OptionTrait
{
    public $option_data;
    public $option_query;
    public $option_label;
    public $option_name;
    public $option_id;

    abstract public function optionId(): string;
    abstract public function optionName(): string;
    abstract public function optionData();

    public function setId($value = false)
    {
        $this->option_id = $this->optionId();
        if ($value) {
            $this->option_id = $value;
        }
        return $this;
    }

    public function setName($value = false)
    {
        $this->option_name = $this->optionName();
        if ($value) {
            $this->option_name = $value;
        }
        return $this;
    }

    public function setLabel($value = false)
    {
        $this->option_label = __('- Select Option -');
        if ($value) {
            $this->option_label = $value;
        }
        return $this;
    }

    public function optionBuild($raw = false)
    {
        $this->option_data = Filter::getFilter($this->optionData());

        if ($raw) {
            return $this->option_data;
        }

        $this->setId($this->option_id);
        $this->setName($this->option_name);
        $this->setLabel($this->option_label);

        $this->option_data = $this->option_data
            ->pluck($this->option_name, $this->option_id)
            ->prepend($this->option_label, '');

        return $this->option_data;
    }
}
