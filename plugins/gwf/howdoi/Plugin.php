<?php namespace gwf\Howdoi;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'Gwf\Howdoi\Components\Howdoilinks' => 'howdoilinks',
    		'Gwf\Howdoi\Components\Singlehowdoi' => 'Singlehowdoi',
    	];
    }

    public function registerSettings()
    {
    }
}
