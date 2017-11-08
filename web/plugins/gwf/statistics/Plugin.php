<?php namespace gwf\Statistics;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'Gwf\Statistics\Components\Statistics' => 'statistics'
    	];
    }

    public function registerSettings()
    {
    }
}
