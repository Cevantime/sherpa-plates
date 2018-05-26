<?php

namespace Sherpa\Plates;

/**
 * Description of PostInstall
 *
 * @author cevantime
 */
class PostInstall
{

    public static function execute()
    {
        $templateFolder = 'templates';
        $layoutFileName = 'layout';
        $templateFileName = 'home';

        if (!file_exists($templateFolder)) {
            mkdir($templateFolder);
        }

        $layout = "<?php
/* @var \$this League\Plates\Template\Template */
?>
<html>
    <head>
        <title>Test Plates</title>
    </head>
    <body>
        <?php echo \$this->section('body'); ?>
    </body>
</html>";

        $template = "<?php
/* @var \$this League\Plates\Template\Template */
\$this->layout('layout');
?>

<?php \$this->start('body'); ?>
    Hello Plates !!
<?php \$this->stop();";

        if (!file_exists($layoutFile = $templateFolder . '/' . $layoutFileName.'.php')) {
            file_put_contents($layoutFile, $layout);
        }
        if (!file_exists($templateFile = $templateFolder . '/' . $templateFileName.'.php')) {
            file_put_contents($templateFile, $template);
        }
    }

}
