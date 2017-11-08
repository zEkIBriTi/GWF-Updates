<?php namespace Gwf\Advertisements;

use System\Classes\PluginBase;
use gwf\Advertisements\models\Advertisement;

class Plugin extends PluginBase
{
      
    public function pluginDetails()
    {
        return [
            'name'        => 'Advertisements',
            'description' => 'A special plugin for managing Advertisements',
            'author'      => 'Donald Samwel',
            /*'icon'        => 'icon-wrench',*/
            'homepage'    => 'ega.go.tz'
        ];
    }

    public function registerComponents()
    {
    	return [
            'Gwf\Advertisements\Components\SingleAdvertisement' => 'SingleAdvertisement',
            'Gwf\Advertisements\Components\AdvertisementsList' => 'AdvertisementsList'
    	];
    }
    
    public function registerSettings()
    {
    }
    
    public function boot()
    {
    \Event::listen('offline.sitesearch.query', function ($query) {

        // Search your plugin's contents
        $items = Advertisement::where('title', 'like', "%${query}%")
                                        ->orWhere('content', 'like', "%${query}%")
                                        ->get();

        // Now build a results array
        $results = $items->map(function ($item) use ($query) {

            // If the query is found in the title, set a relevance of 2
            $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;

            return [
                'title'     => $item->title,
                'content'      => $item->content,
                'url'       => '/advertisement/:' . $item->slug,
                'thumb'     => $item->url->first(), // Instance of System\Models\File
                'relevance' => $relevance, // higher relevance results in a higher
                                           // position in the results listing
                // 'meta' => 'data',       // optional, any other information you want
                                           // to associate with this result
            ];
        });

        return [
            'provider' => 'Advertisement', // The badge to display for this result
            'results'  => $results,
        ];
    });
    }

}
