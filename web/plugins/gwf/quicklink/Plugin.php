<?php namespace Gwf\Quicklink;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {

    	return [
    		'Gwf\Quicklink\Components\Quicklinks' => 'quicklinks'
    	];
    }

    public function registerSettings()
    {
    }
}
