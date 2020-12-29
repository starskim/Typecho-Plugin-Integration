<?php

class ActivatePowerMode extends Services
{
    public function footer($plugin)
    {
        $colorful = self::exist_value('colorful', $plugin->ActivatePowerMode);
        $shake = self::exist_value('shake', $plugin->ActivatePowerMode);
        if ($colorful || $shake) {
            echo "<script type='text/javascript' src='" . INTEGRATION_STATIC_PATH . "js/ActivatePowerMode.js'></script>\n";
        }
    }
}