<?php

namespace App\Helpers;

use App\Models\WebConfig;

class Helper
{
    /**
     * Get value from the web_config table by column name.
     *
     * @param string $key
     * @return mixed
     */
    public static function webConfig($key, $default = null)
    {
        $config = WebConfig::first();
        
        // Return the requested value or default value if not found
        return $config ? $config->{$key} : $default;
    }
}
