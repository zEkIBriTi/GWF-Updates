<?php namespace Gwf\News;


use System\Classes\PluginBase;
use gwf\news\models\News;

class Plugin extends PluginBase
{

	public function pluginDetails()
    {
        return [
            'name'        => 'News',
            'description' => 'Provides News cool Features',
            'author'      => 'Othman Omary, GWF team',
            /*'icon'        => 'icon-wrench',*/
            'homepage'    => 'ega.go.tz'
        ];
    }

    public function registerComponents()
    {
    	return [
            'Gwf\News\Components\SingleNews' => 'SingleNews',
            'Gwf\News\Components\AllNews' => 'AllNews'
    	];
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
    \Event::listen('offline.sitesearch.query', function ($query) {

        // Search your plugin's contents
        $items = News::where('title', 'like', "%${query}%")
                                        ->orWhere('content', 'like', "%${query}%")
                                        ->get();

        // Now build a results array
        $results = $items->map(function ($item) use ($query) {

            // If the query is found in the title, set a relevance of 2
            $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;

            return [
                'title'     => $item->title,
                'text'      => $item->content,
                'url'       => '/new/:' . $item->slug,
                'thumb'     => $item->url->first(), // Instance of System\Models\File
                'relevance' => $relevance, // higher relevance results in a higher
                                           // position in the results listing
                // 'meta' => 'data',       // optional, any other information you want
                                           // to associate with this result
            ];
        });

        return [
            'provider' => 'News', // The badge to display for this result
            'results'  => $results,
        ];
    });
    }

}
