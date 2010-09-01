<?php
/**
 * Menu Widget, displays the menu items and the current position
 * 
 * @package Xinc.Plugin
 * @author Arno Schneider
 * @version 2.0
 * @copyright 2007 Arno Schneider, Barcelona
 * @license  http://www.gnu.org/copyleft/lgpl.html GNU/LGPL, see license.php
 *    This file is part of Xinc.
 *    Xinc is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU Lesser General Public License as published
 *    by the Free Software Foundation; either version 2.1 of the License, or    
 *    (at your option) any later version.
 *
 *    Xinc is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU Lesser General Public License for more details.
 *
 *    You should have received a copy of the GNU Lesser General Public License
 *    along with Xinc, write to the Free Software
 *    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

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
    
    private $_tmpDir = '/tmp/';

	private $project;

	private $build;
        
    public function __construct(Xinc_Plugin_Interface &$plugin)
    {
        $this->_plugin = $plugin;
        try {
            $this->_tmpDir = Xinc_Ini::getInstance()->get('tmp_dir', 'xinc');
        } catch (Exception $e) {
            $this->_tmpDir = '/tmp/';
        }
        
    }
    
    public function handleEvent($eventId)
    {
		if (isset($_REQUEST['project'])) {
			$this->_projectName = $_REQUEST['project'];
		} else {
			throw new Exception('No project name passed');
		}
		$url = $_SERVER['REDIRECT_URL'];
		switch($url) {
			case '/forcebuild':
			case '/forcebuild/':

				$statusDir = Xinc_Gui_Handler::getInstance()->getStatusDir();

				$touchFile = $statusDir . DIRECTORY_SEPARATOR
						. $this->_projectName . DIRECTORY_SEPARATOR
						. 'build.launcher';

				$result = @touch($touchFile);

				echo (int)$result;

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
    
    public function registerExtension($extensionPoint, &$extension)
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