<?php

require_once 'Xinc/Build/Interface.php';
require_once 'Xinc/Plugin/Base.php';
require_once 'Xinc/Plugin/Repos/ModificationSet/Interface.php';
require_once 'Xinc/Plugin/Repos/ModificationSet/Result.php';
require_once 'Xinc/Plugin/Repos/ModificationSet/AbstractTask.php';
require_once 'ForceBuild/Task.php';

/**
 * @author Aigars Gedroics
 */
class Gedrox_Plugin_ModificationSet_ForceBuild extends Xinc_Plugin_Base
{
	public function getTaskDefinitions()
    {
        return array(new Gedrox_Plugin_ModificationSet_ForceBuild_Task($this));
    }

	public function checkModified(Xinc_Build_Interface $build)
	{
		$result = new Xinc_Plugin_Repos_ModificationSet_Result();

		$statusDir = Xinc::getInstance()->getStatusDir();
		$projectName = $build->getProject()->getName();

		$path = $statusDir . DIRECTORY_SEPARATOR
				. $projectName . DIRECTORY_SEPARATOR
				. 'build.launcher';

		if (file_exists($path)) {
			if (filesize($path) != 0) {
				throw new Exception("The launch trigger file is supposed to be empty");
			}
			$res = unlink($path);
			if ($res === false) {
				throw new Exception("Could not remove launcher file");
			}
			$result->setChanged(true);
			$result->setStatus(Xinc_Plugin_Repos_ModificationSet_AbstractTask::CHANGED);
		}

        return $result;
	}

}
