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
        
        $layout = "<?php\n
/* @var $this League\Plates\Template\Template */\n
?>\n
\n
<html>\n
    <head>\n
        <title>Test Plates</title>\n
    </head>\n
    <body>\n
        <?php echo \$this->section(\'body\'); ?>\n
    </body>\n
</html>";
        
        $template = "<?php\n
/* @var \$this League\Plates\Template\Template */\n
\n
\$this->layout(\'layout\');\n
?>\n
<?php \$this->start(\'body\'); ?>\n
Hello Plates !!\n
<?php \$this->stop();";
        
        file_put_contents($templateFolder.'/'.$layoutFileName, $layout);
        file_put_contents($templateFolder.'/'.$templateFileName, $template);
    }
}
