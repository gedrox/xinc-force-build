#This describes how to install the force-build xinc plugin

# Installation #

  1. Checkout the source as described in http://code.google.com/p/xinc-force-build/source/checkout.
  1. Add these lines into /etc/xinc/system.xml xinc configuration file:
```
<plugin filename="/path/to/plugin/xinc-force-build-read-only/lib/Gedrox/Plugin/ModificationSet/ForceBuild.php" classname="Gedrox_Plugin_ModificationSet_ForceBuild"/>
<plugin filename="/path/to/plugin/xinc-force-build-read-only/lib/Gedrox/Plugin/Gui/ForceBuild.php" classname="Gedrox_Plugin_Gui_ForceBuild"/>
```
  1. Add this line
```
<forcebuild />
```
> in the project configuration file (under /etc/xinc/conf.d/) under XML node /project/modificationset.
> Example:
```
<project name="...">
    ...
    <cron timer="*/5 * * * *"/>
    <modificationset>
        <svn directory="${dir}" />
        <forcebuild />
    </modificationset>
    ...
</project>
```
  1. Check the HTTP server user has permission to create a file in the project data folder "/var/xinc/status/{project\_name}/". For some reason folders "/var/xinc/" and "/var/xinc/status/" didn't have listing permission for the owner out of the box. Had to run these commands:
```
$ chmod +x /var/xinc/
$ chmod +x /var/xinc/status/
```