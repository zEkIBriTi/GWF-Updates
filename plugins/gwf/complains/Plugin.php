<?php namespace gwf\Complains;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {

    return [
    		'Gwf\Complains\Components\Complainlist' => 'complainForm'		
    	];
    }

    public function registerSettings()
    {
    }
}
