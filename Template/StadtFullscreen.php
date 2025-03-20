<?php
namespace DanielKnoop\StadtBundle\Template;

use Mapbender\CoreBundle\Component\Template;
use Mapbender\CoreBundle\Entity\Application;
use Mapbender\CoreBundle\Form\Type\Template\Fullscreen\SidepaneSettingsType;
use Mapbender\CoreBundle\Form\Type\Template\Fullscreen\ToolbarSettingsType;
use Mapbender\CoreBundle\Utils\ArrayUtil;

class StadtFullscreen extends Template {

    public static function getTitle()
    {
        return 'Stadt Monheim Fullscreen (Vorlage)';
    }
}


