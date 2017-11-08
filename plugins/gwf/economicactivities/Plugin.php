<?php namespace Gwf\EconomicActivities;

use System\Classes\PluginBase;
use gwf\economicactivities\models\EconomicActivity;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    	return [
            'Gwf\Economicactivities\Components\EconomicActivities' => 'EconomicActivities',
            'Gwf\Economicactivities\Components\SingleEconomicActivity' => 'SingleEconomicActivity'
    	];

    }

    public function registerSettings()
    {
    }

    public function boot()
    {
    \Event::listen('offline.sitesearch.query', function ($query) {

        // Search your plugin's contents
        $items = EconomicActivity::where('activityname', 'like', "%${query}%")
                                        ->orWhere('description', 'like', "%${query}%")
                                        ->get();

        // Now build a results array
        $results = $items->map(function ($item) use ($query) {

            // If the query is found in the title, set a relevance of 2
            $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;

            return [
                'title'     => $item->title,
                'text'      => $item->content,
                'url'       => '/economic-activity/:' . $item->slug,
                //'thumb'     => $item->url->first(), // Instance of System\Models\File
                'relevance' => $relevance, // higher relevance results in a higher
                                           // position in the results listing
                // 'meta' => 'data',       // optional, any other information you want
                                           // to associate with this result
            ];
        });

        return [
            'provider' => 'Economic Activities', // The badge to display for this result
            'results'  => $results,
        ];
    });
    }
}
