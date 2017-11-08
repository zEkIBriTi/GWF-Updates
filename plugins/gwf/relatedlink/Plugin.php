<?php namespace gwf\Relatedlink;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'Gwf\Relatedlink\Components\RelatedlinkList' => 'relatedlink'
    	];
    }

    public function registerSettings()
    {
    }
}
