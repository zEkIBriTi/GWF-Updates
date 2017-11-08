<?php namespace Gwf\Faq\Models;

use Model;

/**
 * Model
 */
class FrequentAskedQuestionsController extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\Sluggable;

    /*
     * Validation
     */
    public $rules = [
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_faq_faq';

    public function beforeSave()
    {
        protected $slugs = ['slug' => 'questions'];
    }


}