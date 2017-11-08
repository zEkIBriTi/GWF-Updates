<?php namespace gwf\Publication;

use System\Classes\PluginBase;
use gwf\publication\models\Publication;
use System\Models\File;


class Plugin extends PluginBase
{
	public function pluginDetails()
    {
        return [
            'name'        => 'gwf.publication::lang.plugin.name',
            'description' => 'gwf.publication::lang.plugin.description',
            'author'      => 'Donald Samwel',
            'icon'        => 'oc-icon-file-powerpoint-o',
            'homepage'    => ''
        ];
    }

    public function registerComponents()
    {
    	return [
            'Gwf\Publication\Components\PublicationList'       => 'publicationList',
            'Gwf\Publication\Components\PublicationDetails'       => 'PublicationDetails',
            'Gwf\Publication\Components\Publications' => 'Publications'
        ];
    }

    public function registerSettings()
    {
    	
    }

    public function boot()
    {
    \Event::listen('offline.sitesearch.query', function ($query) {

        // Search your plugin's contents
        $items = Publication::where('title', 'like', "%${query}%")
                                        //->orWhere('content', 'like', "%${query}%")
                                        ->get();

        // Now build a results array
        $results = $items->map(function ($item) use ($query) {

            // If the query is found in the title, set a relevance of 2
            $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;
        
        

            return [
                'title'     => $item->title,
                'text'      => $item->content,
                'url'       => $item->document_link->path,
               /* 'thumb'     => $item->document_link.path,*/ // Instance of System\Models\File
                'relevance' => $relevance, // higher relevance results in a higher
                                           // position in the results listing
                // 'meta' => 'data',       // optional, any other information you want
                                           // to associate with this result
            ];
        });

        return [
            'provider' => 'Publications', // The badge to display for this result
            'results'  => $results,
        ];
    });
    }


    public function get_file_name_byID($id)
    {
        return File::where('attachment_id', $id)->first();
    }
}
