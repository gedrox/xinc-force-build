<?php

require_once 'Xinc/Gui/Widget/Interface.php';
require_once 'Xinc/Build/Iterator.php';
require_once 'Xinc/Project.php';
require_once 'Xinc/Build.php';
require_once 'Xinc/Build/History.php';
require_once 'Xinc/Build/Repository.php';
require_once 'Xinc/Plugin/Repos/Gui/Menu/Extension/Item.php';
require_once 'Xinc/Plugin/Repos/Gui/Statistics/Extension/Prominent.php';
require_once 'Xinc/Plugin/Repos/Gui/Statistics/Graph/BuildDuration.php';
require_once 'Xinc/Plugin/Repos/Gui/Statistics/Graph/BuildStatus.php';
require_once 'Xinc/Plugin/Repos/Gui/Statistics/Graph/PhpUnitTestResults.php';
require_once 'Extension/Prominent.php';

/**
 * @author Aigars Gedroics
 */
class Gedrox_Plugin_Gui_ForceBuild_Build implements Xinc_Gui_Widget_Interface
{
    protected $_plugin;

    public $scripts = '';

    public function __construct(Xinc_Plugin_Interface &$plugin)
    {
        $this->_plugin = $plugin;
    }

    public function handleEvent($eventId)
    {

    }


    public function getPaths()
    {
        return array();
    }
	
    
    public function init()
    {
        $extension = new Gedrox_Plugin_Gui_ForceBuild_Extension_Prominent();
        $extension->setWidget($this);

        $detailWidget = Xinc_Gui_Widget_Repository::getInstance()->
                                                    getWidgetByClassName('Xinc_Plugin_Repos_Gui_Dashboard_Detail');

        $detailWidget->registerExtension('BUILD_SUMMARY', $extension);

        $dashboardWidget = Xinc_Gui_Widget_Repository::getInstance()->
                                                    getWidgetByClassName('Xinc_Plugin_Repos_Gui_Dashboard_Widget');

        $dashboardWidget->registerExtension('PROJECT_FEATURE', $extension);

    }


    public function registerExtension($extensionPoint, &$extension)
    {


    }
    public function getExtensionPoints()
    {
        return array();
    }
    public function hasExceptionHandler()
    {
        return false;
    }
    public function handleException(Exception $e)
    {

    }
}