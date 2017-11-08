<?php namespace Gwf\Quicklink\Models;

use Model;

/**
 * Model
 */
class QuickLink extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Validation
     */
    public $rules = [
        'title' => 'required',
        'url' => 'required',
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
    public $table = 'gwf_quicklink_quick_links';
}