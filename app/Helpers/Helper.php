<?php

use App\Models\WebConfig;

if (!function_exists('webConfig')) {
    /**
     * Get value from the web_config table by column name.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function webConfig($key, $default = null)
    {
        $config = WebConfig::first();

        // Return the requested value or default value if not found
        return $config ? $config->{$key} : $default;
    }
}
