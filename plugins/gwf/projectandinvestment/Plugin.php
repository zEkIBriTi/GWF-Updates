<?php namespace gwf\projectandinvestment;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
    		'Gwf\Projectandinvestment\Components\Projectandinvestmentlist' => 'Projectandinvestmentlist',
    		'Gwf\Projectandinvestment\Components\Singleproject' => 'Singleproject',
            'Gwf\Projectandinvestment\Components\Categoryprojects' => 'Categoryprojects'
    	];
    }
    }

   //public function registerSettings()
   // {
