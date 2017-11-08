<?php namespace Gwf\Events\Models;

use Model;
use BackendAuth;
use October\Rain\Database\Attach\File;

/**
 * Model
 */
class Event extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['title','content'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;
    //public $timestamps = true;

    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_events_events';
    
    public $attachOne = ['event_photo' => 'System\Models\File'];

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