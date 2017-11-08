<?php namespace gwf\Dashboardlinks;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'Gwf\dashboardlinks\Components\Dashboard' => 'Dashboard'
    	];
    }

    public function registerSettings()
    {
    }
}
