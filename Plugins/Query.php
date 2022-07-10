<?php

namespace Plugins;

class Query
{
    public static function upsert($model, $where, $data)
    {
        $batch = $model->where($where)->first();
        if ($batch) {
            $batch->update($data);
        } else {
            $model->create($data);
        }
    }
}
