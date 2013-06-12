<?php

require_once 'Xinc/Plugin/Repos/Gui/Dashboard/Extension/ProjectInfo.php';
require_once 'Xinc/Plugin/Repos/Documentation.php';

/**
 * @author Aigars Gedroics
 */
class Gedrox_Plugin_Gui_ForceBuild_Extension_Prominent
		extends Xinc_Plugin_Repos_Gui_Dashboard_Extension_ProjectInfo
{
	public function getTitle()
    {
        return 'Force Build';
    }
    public function getContent(Xinc_Build_Interface $build)
    {

        $projectName = $build->getProject()->getName();
		
		$statusDir = Xinc_Gui_Handler::getInstance()->getStatusDir();
		$touchFile = $statusDir . DIRECTORY_SEPARATOR
				. $projectName . DIRECTORY_SEPARATOR
				. 'build.launcher';

		if (file_exists($touchFile)) {
			return 'Queued';
		}

        $url = '/forcebuild/?project=' . $projectName;
		$click = <<<DOC
var self = this;
self.innerHTML = 'Please Wait...';
Ext.Ajax.request({
	url: '{$url}',
	success: function(response){
		if (response.responseText == 1) {
			self.outerHTML = 'Queued';
		} else {
			self.innerHTML = 'Error. Try again.';
		}
	},
	failure: function(){
		self.innerHTML = 'Error. Try again.';
	}
});
DOC;
		$click = str_replace(array("\r", "\n"), array(' ', ' '), $click);
		return '<a href="javascript://" onclick="'. htmlspecialchars($click) . '">Build</a>';
    }
    public function getExtensionPoint()
    {
        return 'BUILD_SUMMARY';
    }
}
