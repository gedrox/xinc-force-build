<?php

require_once 'Xinc/Plugin/Base.php';
require_once 'ForceBuild/Build.php';
require_once 'ForceBuild/Widget.php';

/**
 * @author Aigars Gedroics
 */
class Gedrox_Plugin_Gui_ForceBuild extends Xinc_Plugin_Base
{
    public function validate()
    {
        return true;
    }
    public function getGuiWidgets()
    {
        return array(new Gedrox_Plugin_Gui_ForceBuild_Build($this),
				new Gedrox_Plugin_Gui_ForceBuild_Widget($this));
    }
}
