<?php namespace Gwf\News\Models;


use October\Rain\Support\Markdown;
use October\Rain\Support\ValidationException;
use October\Rain\Database\Attach\File;
use Model;
use BackendAuth;

/**
 * Model
 */
class News extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'content' => 'required',
        'published_date' => 'required',
    ];

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['title','content'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_news_news';

    public $attachOne = ['url' => 'System\Models\File']; 

        protected  $slugs = ['slug' => 'title'];

    public function beforeCreate()
    {

    }

    public function beforeSave()
    {
        $user = BackendAuth::getUser();
        $this->recorder = $user->id;
    }
}