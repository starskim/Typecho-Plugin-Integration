<?php

require_once 'Handsomes.php';

class LocalConst extends Services
{
    public function header($plugin)
    {
        $options = Helper::options();
        $array = array();
        $array["General"] = trim(str_replace(".", "();", implode("\n", $plugin->General)));
        if (self::GetTheme() == 'handsome') {
            $array["handsome"] = trim(str_replace(".", "();", implode("\n", $plugin->handsome)));
        }
        $colorful = self::exist_value('colorful', $plugin->ActivatePowerMode);
        $shake = self::exist_value('shake', $plugin->ActivatePowerMode);
        $bubbleText = explode('-', $plugin->bubbleText);
        ?>
        <script type="text/javascript">
            window['Integration_LocalConst'] = {
                BLOG_URL: `<?php echo substr(BLOG_URL, 8, -1) ?>`,
                STATIC_PATH: `<?php echo INTEGRATION_STATIC_PATH ?>`,
                INIT: <?php echo json_encode($array);?>,
                GET_THEME: `<?php echo self::GetTheme() ?>`,
                COPYRIGHT_TYPE: <?php echo $plugin->copyrightType ?>,
                RETURN_TOP:<?php echo $plugin->ReturnTop; ?>,
                COLORFUL:<?php echo $colorful ? 'true' : 'false'; ?>,
                SHAKE:<?php echo $shake ? 'true' : 'false'; ?>,
                MOUSE_TYPE: `<?php echo $plugin->mouseType?>`,
                BUBBLE: {
                    Color: `<?php echo $plugin->bubbleColor ?>`,
                    Speed: `<?php echo (int)$plugin->bubbleSpeed ?>`,
                    Text:<?php echo json_encode($bubbleText, JSON_UNESCAPED_UNICODE) ?>,
                },
                HANDSOME: {
                    BlogJob: `<?php $options->BlogJob() ?>`,
                    TotalVisit: `<?php echo (new Handsomes)->TotalVisit() ?>`
                }
            }
        </script>
        <?php
    }
}