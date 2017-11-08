<?php namespace Gwf\Events;

use System\Classes\PluginBase;
use gwf\events\models\Event;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Events',
            'description' => 'Provides Events cool Features',
            'author'      => 'Othman Omary, GWF team',
            /*'icon'        => 'icon-wrench',*/
            'homepage'    => 'ega.go.tz'
        ];
    }

    public function registerComponents()
    {
    	return [
    		'Gwf\events\Components\Events' => 'Events',
    		'Gwf\events\Components\Singleevent' => 'Singleevent',
    	];
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
    \Event::listen('offline.sitesearch.query', function ($query) {

        // Search your plugin's contents
        $items = Event::where('title', 'like', "%${query}%")
                                        ->orWhere('content', 'like', "%${query}%")
                                        ->get();

        // Now build a results array
        $results = $items->map(function ($item) use ($query) {

            // If the query is found in the title, set a relevance of 2
            $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;

            return [
                'title'     => $item->title,
                'text'      => $item->content,
                'url'       => '/event/:' . $item->slug,
                //'thumb'     => $item->url->first(), // Instance of System\Models\File
                'relevance' => $relevance, // higher relevance results in a higher
                                           // position in the results listing
                // 'meta' => 'data',       // optional, any other information you want
                                           // to associate with this result
            ];
        });

        return [
            'provider' => 'Events', // The badge to display for this result
            'results'  => $results,
        ];
    });
    }
}
