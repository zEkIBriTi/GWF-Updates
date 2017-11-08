<?php namespace Gwf\Faq\Models;

use Model;
use BackendAuth;
/**
 * Model
 */
class Faq extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
        'questions' => 'required',
        'answers' => 'required',
    ];

    public $implement =['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['questions','answers'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_faq_faq';

    protected $slugs = ['slug' => 'questions'];


    public function beforeSave()
    {
        $user = BackendAuth::getUser();
        $this->user_id = $user->id;
    }
}