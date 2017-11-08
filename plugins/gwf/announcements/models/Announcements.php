<?php namespace Gwf\announcements\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class Announcements extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'content' => 'required',
        'published_date' => 'required'
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
    public $table = 'gwf_announcements_announcements';
    protected $slugs = ['slug' => 'title'];

    public function beforeSave()
    {
        $user = BackendAuth::getUser();
        $this->user_id = $user->id;
    }
}