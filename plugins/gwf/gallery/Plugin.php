<?php namespace Gwf\Gallery;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
            'Gwf\Gallery\Components\GalleryList'       => 'GalleryList',
            'Gwf\Gallery\Components\GalleryDetails'    => 'GalleryDetails',
            'Gwf\Gallery\Components\VideoList'       => 'VideoList',
            'Gwf\Gallery\Components\LatestVideo'    => 'LatestVideo'
        ];
    }

    public function registerSettings()
    {
    }
}
