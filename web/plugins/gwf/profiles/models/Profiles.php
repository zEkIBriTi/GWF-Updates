<?php namespace Gwf\Profiles\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class Profiles extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'salutation' => 'required|max:10',
        'name' => 'required',
        'title' => 'required',
        'bio' => 'required'
    ];

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['salutation','name','title','bio'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_profiles_profiles';

    protected $slugs = ['slug' => 'name'];

    public $attachOne = ['image_url' => 'System\Models\File'];

    public function beforeSave()
    {
        $this->recorder = BackendAuth::getUser()->id;
    }
}