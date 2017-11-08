<?php namespace Gwf\Advertisements\Models;

use Model;
use BackendAuth;
use October\Rain\Support\Markdown;
use October\Rain\Database\Attach\File;
use October\Rain\Support\ValidationException;

/**
 * Model
 */
class Advertisement extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
      'content' => 'required',
      'advert_photo'	=>	'required'
    ];

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['title','content'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_advertisements_advertisements';
    
    public $attachOne = ['advert_photo' => 'System\Models\File'];

    protected  $slugs = ['slug' => 'title'];
    
    public function beforeSave()
    {
        
    }
}