<?php

namespace App\Modules\Core\Traits;

trait ModelBaseTrait
{
    public static function fields(): array
    {
        $self = self::make();

        if (!property_exists($self, 'fillable')) return [];

        return $self->fillable;
    }

    public static function onlyFields(array $data = [], array $fields = []): array
    {
        if(!count($data) || !count($data)) return [];

        $returnData = [];

        foreach ($fields as $field) {
            if (!isset($data[$field])) $data[$field] = null;
            $returnData[$field] = $data[$field];
        }

        return $returnData;
    }
}
