<?php namespace Gwf\Gallery\Components;


use Lang;
use Cms\Classes\Page;
use RainLab\Builder\Classes\ComponentHelper;
use SystemException;
use Exception;
use Cms\Classes\ComponentBase;
use Gwf\Gallery\Models\Video;

class LatestVideo extends ComponentBase
{
    public $video;


    /**
         * Used to show all videos
    */
    public $viewAll;

    /**
     * Message to display when there are no records.
     * @var string
     */
    public $noRecordsMessage;


public function ComponentDetails(){
    return [
            'name' => "Latest Video",
            'description' => "Currently uploaded video"
    ];
}


protected function loadVideos(){
    $video = Video::where('activation_status', 1)->orderby('id','DESC')->limit(1)->first();
    return $video;
}

    public function defineProperties()
{
    return [

        'noRecordsMessage' => [
            'title'        => 'rainlab.builder::lang.components.list_no_records',
            'description'  => 'rainlab.builder::lang.components.list_no_records_description',
            'type'         => 'string',
            'default'      => Lang::get('rainlab.builder::lang.components.list_no_records_default'),
            'showExternalParam' => false,
        ],

        'viewAll' => [
            'title'       => 'View All',
            'description' => 'rainlab.builder::lang.components.list_details_page_description',
            'type'        => 'dropdown',
            'showExternalParam' => false,
            'group'       => 'rainlab.builder::lang.components.list_detalis_page_link'
        ]

    ];
}


public function onRun(){
            $this->prepareVars();
     $this->video = $this->loadVideos();
}

public function getViewAllOptions()
    {
        $pages = Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');

        $pages = [
            '-' => Lang::get('rainlab.builder::lang.components.list_details_page_no')
        ] + $pages;

        return $pages;
    }


protected function prepareVars()
    {
        $this->noRecordsMessage = $this->page['noRecordsMessage'] = Lang::get($this->property('noRecordsMessage'));
        // $this->displayColumn = $this->page['displayColumn'] = $this->property('displayColumn');

        $viewAll = $this->property('viewAll');
        if ($viewAll == '-') {
            $viewAll = null;
        }
        $this->viewAll = $this->page['viewAll'] = $viewAll;

    }
}

