<?php namespace Gwf\Profiles;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
            'Gwf\Profiles\Components\Profilelist' => 'profilelist',
    		'Gwf\Profiles\Components\Singleprofile' => 'singleprofile'
    		
    	];
    }

    public function registerSettings()
    {
    }
}
