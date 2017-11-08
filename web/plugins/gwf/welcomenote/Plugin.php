<?php namespace Gwf\Welcomenote;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'Gwf\Welcomenote\Components\Welcome' => 'welcome',
    	];
    }

    public function registerSettings()
    {
    }
}
