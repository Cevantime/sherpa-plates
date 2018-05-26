<?php

namespace Sherpa\Plates;

/**
 * Description of PostInstall
 *
 * @author cevantime
 */
class PostInstall
{
    public function execute()
    {
        $templateFolder = 'templates';
        $layoutFileName = 'layout';
        $templateFileName = 'home';
        
        mkdir($templateFolder);
        
        $layout = '<?php
/* @var $this League\Plates\Template\Template */
?>

<html>
    <head>
        <title>Test Plates</title>
    </head>
    <body>
        <?php echo $this->section(\'body\'); ?>
    </body>
</html>';
        
        $template = '<?php
/* @var $this League\Plates\Template\Template */

$this->layout(\'layout\');
?>
<?php $this->start(\'body\'); ?>
Hello Plates !!
<?php $this->stop();';
        
        file_put_contents($templateFolder.'/'.$layoutFileName, $layout);
        file_put_contents($templateFolder.'/'.$templateFileName, $template);
    }
}
