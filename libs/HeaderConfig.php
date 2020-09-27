<?php

require_once 'Services/RobotsPlus.php';
require_once 'Services/ReturnTop.php';

class headerConfig extends Services
{
    /**
     * 页头输出相关代码
     *
     * @access public
     * @param unknown header
     * @return unknown
     */
    public function header()
    {
        $options = Helper::options();
        $config = $options->plugin('Integration');
        $PluginPath = $options->pluginUrl . '/Integration/assets/';
        self::LocalConst();
        echo '<link rel="stylesheet" type="text/css" href="' . $PluginPath . 'css/Integration.css" />';
        RobotsPlus::header($config);
        ReturnTop::header($config, $PluginPath);

    }

    public function LocalConst()
    {
        ?>
        <script type="text/javascript">
            window['Integration_LocalConst'] = {
                Integration_VERSION: '<?php echo INTEGRATION_VERSION ?>'

            }
        </script>
        <?php

    }
}