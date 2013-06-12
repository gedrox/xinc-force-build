<?php

require_once 'Xinc/Plugin/Repos/ModificationSet/BuildAlways/Task.php';
require_once 'Xinc/Build/Interface.php';

/**
 * @author Aigars Gedroics
 */
class Gedrox_Plugin_ModificationSet_ForceBuild_Task extends Xinc_Plugin_Repos_ModificationSet_BuildAlways_Task
{
    public function getName(){
         // return the task-element-name you want to use
         return "forcebuild";
    }
	
	public function checkModified(Xinc_Build_Interface $build)
    {
        return $this->_plugin->checkModified($build);
    }


}
