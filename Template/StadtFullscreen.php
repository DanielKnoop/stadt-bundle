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
    
    public static function getRegionsProperties()
    {
        return array(
            'sidepane' => array(
                'accordion' => array(
                    'name' => 'accordion',
                ),
                'tabs' => array(
                    'name' => 'tabs',
                ),
            ),
        );
    }
    


    public function getRegionClasses(Application $application, $regionName)
    {
        $classes = parent::getRegionClasses($application, $regionName);
        switch ($regionName) {
            default:
                break;
            case 'sidepane':
                $props = $this->extractRegionProperties($application, $regionName);
                $classes[] = ArrayUtil::getDefault($props, 'align') ?: 'left';
                if (!empty($props['closed'])) {
                    $classes[] = 'closed';
                }
                break;
        }
        return $classes;
    }

    public function getSassVariablesAssets(Application $application)
    {
        return array(
            '@MapbenderCoreBundle/Resources/public/sass/libs/_variables.scss',
            '@DanielKnoopStadtBundle/Resources/public/stadt_fullscreen.scss',
        );
    }

    /**
     * @inheritdoc
     */
    public function getAssets($type)
    {
        switch ($type) {
            case 'css':
                return array(
                    '@DanielKnoopStadtBundle/Resources/public/stadt_fullscreen.scss',
                    '@MapbenderCoreBundle/Resources/public/sass/modules/_popup_dialog.scss',
                    '@MapbenderCoreBundle/Resources/public/sass/modules/_tab_navigator.scss',
                );
            case 'js':
                return array(
                    '@MapbenderCoreBundle/Resources/public/widgets/sidepane.js',
                    '@MapbenderCoreBundle/Resources/public/mapbender.container.info.js',
                );
            case 'trans':
            default:
                return parent::getAssets($type);
        }
    }

    /**
     * @inheritdoc
     */
    public static function getRegions()
    {
        return array('toolbar', 'sidepane', 'content', 'footer');
    }

    public function getTwigTemplate()
    {
        return '@DanielKnoopStadtBundle/Resources/views/stadt_fullscreen.html.twig';
    }

    public function getBodyClass(Application $application)
    {
        return 'desktop-template';
    }

    /**
     * @param string $regionName
     * @return string|null
     */
    public static function getRegionSettingsFormType($regionName)
    {
        switch ($regionName) {
            case 'sidepane':
                return SidepaneSettingsType::class;
            case 'toolbar':
            case 'footer':
                return ToolbarSettingsType::class;
            default:
                return null;
        }
    }

    public static function getRegionPropertiesDefaults($regionName)
    {
        switch ($regionName) {
            case 'toolbar':
            case 'footer':
                return array(
                    'item_alignment' => 'right',
                    'generate_button_menu' => false,
                );
            case 'sidepane':
                return array(
                    'name' => 'accordion',
                    'align' => 'left',
                    'closed' => false,
                    'resizable' => true,
                );
            default:
                return parent::getRegionPropertiesDefaults($regionName);
        }
    }    
}


