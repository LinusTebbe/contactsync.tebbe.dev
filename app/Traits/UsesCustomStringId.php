<?php


namespace App\Traits;


use Illuminate\Support\Str;

trait UsesCustomStringId
{
    protected static function bootUsesCustomStringId()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::random(10);
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
