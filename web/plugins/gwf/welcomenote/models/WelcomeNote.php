<?php namespace Gwf\Welcomenote\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class WelcomeNote extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'content' => 'required'
    ];

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['title'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_welcomenote_welcome_notes';

    protected $slugs = ['slug' => 'title'];


    public function beforeSave()
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->recorder = BackendAuth::getUser()->id;
    }
}