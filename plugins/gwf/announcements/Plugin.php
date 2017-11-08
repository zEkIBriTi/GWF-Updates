<?php namespace Gwf\announcements;

use System\Classes\PluginBase;
use gwf\announcements\models\Announcements;

class Plugin extends PluginBase
{
    public function registerComponents()
    {

    	return [
    		'Gwf\Announcements\Components\Announcement' => 'Announcement',
    		'Gwf\Announcements\Components\Singleannouncement' => 'singleannouncement'
    	];
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
    \Event::listen('offline.sitesearch.query', function ($query) {

        // Search your plugin's contents
        $items = Announcements::where('title', 'like', "%${query}%")
                                        ->orWhere('content', 'like', "%${query}%")
                                        ->get();

        // Now build a results array
        $results = $items->map(function ($item) use ($query) {

            // If the query is found in the title, set a relevance of 2
            $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;

            return [
                'title'     => $item->title,
                'text'      => $item->content,
                'url'       => '/announcement/' . $item->slug,
                //'thumb'     => $item->images->first(), // Instance of System\Models\File
                'relevance' => $relevance, // higher relevance results in a higher
                                           // position in the results listing
                // 'meta' => 'data',       // optional, any other information you want
                                           // to associate with this result
            ];
        });

        return [
            'provider' => 'Announcements', // The badge to display for this result
            'results'  => $results,
        ];
    });
}
}
