<?php

namespace BRKsReginaldo\Fragmented;

class StubReplaces
{
    public static function getReplaces($module)
    {
        return [
            'DummyModuleName' => $module,
            'StudlyDummyModuleName' => studly_case($module),
            'LowerDummyModuleName' => snake_case($module),
            'KebabDummyModuleName' => kebab_case($module),
            'DummyControllerNamespace' => 'Modules\\' . $module . '\\Http\\Controllers',
            'DummyServiceProviderNamespace' => 'Modules\\'.$module.'\\Providers',
        ];
    }
}