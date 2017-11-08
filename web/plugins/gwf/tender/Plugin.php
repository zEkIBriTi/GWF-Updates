<?php namespace Gwf\Tender;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'Gwf\Tender\Components\TenderList'       => 'TenderList',
    	];
    }

    public function registerSettings()
    {
    }
}
