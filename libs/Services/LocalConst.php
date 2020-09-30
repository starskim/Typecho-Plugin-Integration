<?php


class LocalConst
{
    public function header($plugin)
    {

        ?>
        <script type="text/javascript">
            window['Integration_LocalConst'] = {
                BLOG_URL: '<?php echo substr(BLOG_URL, 8, -1); ?>',
                Pjax:<?php echo $plugin->pjax ?>,
            }
        </script>
        <?php

    }
}