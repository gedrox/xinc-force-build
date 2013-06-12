<?php

require_once 'Xinc/Gui/Widget/Interface.php';
require_once 'Xinc/Build/Iterator.php';
require_once 'Xinc/Project.php';
require_once 'Xinc/Build.php';
require_once 'Xinc/Plugin/Repos/Gui/Menu/Extension/Item.php';
require_once 'Xinc/Plugin/Repos/Gui/Statistics/Menu/Item.php';
require_once 'Xinc/Data/Repository.php';
require_once 'Xinc/Build/History.php';
require_once 'Xinc/Build/Repository.php';

/**
 * @author Aigars Gedroics
 */
class Gedrox_Plugin_Gui_ForceBuild_Widget implements Xinc_Gui_Widget_Interface
{
	/**
	 * @var Gedrox_Plugin_Gui_ForceBuild
	 */
    protected $_plugin;
    
    private $_extensions = array();
    
    public $scripts = '';
    
    private $_projectName;
    
//    private $_tmpDir = '/tmp/';
//
//	private $project;
//
//	private $build;
        
    public function __construct(Xinc_Plugin_Interface $plugin)
    {
        $this->_plugin = $plugin;
//        try {
//            $this->_tmpDir = Xinc_Ini::getInstance()->get('tmp_dir', 'xinc');
//        } catch (Exception $e) {
//            $this->_tmpDir = '/tmp/';
//        }
        
    }
    
    public function handleEvent($eventId)
    {
		if (isset($_REQUEST['project'])) {
			$this->_projectName = $_REQUEST['project'];
		} else {
			throw new InvalidArgumentException('No project name passed');
		}
		$url = $_SERVER['REDIRECT_URL'];
		switch($url) {
			case '/forcebuild':
			case '/forcebuild/':

				$statusDir = Xinc_Gui_Handler::getInstance()->getStatusDir();

				$touchDir = $statusDir . DIRECTORY_SEPARATOR . $this->_projectName;
				$touchFile = $touchDir . DIRECTORY_SEPARATOR . 'build.launcher';

				if ( ! is_writeable($touchDir)) {
					throw new RuntimeException("The directory $touchDir is not writeable");
				}
				
				$result = touch($touchFile);
				echo (int) $result;

               break;
       }
    }
    
    public function getPaths()
    {
        return array('/forcebuild', '/forcebuild/');
    }
    
    public function getProjectName()
    {
        return $this->_projectName;
    }
    
    public function init()
    {
        
    }
    
    public function registerExtension($extensionPoint, $extension)
    {
    }
    
    public function getExtensions()
    {
        return $this->_extensions;
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