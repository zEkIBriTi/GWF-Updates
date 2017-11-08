<?php namespace Gwf\Dashboardlinks\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class Dashboardlink extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
        'url' => 'required',
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'gwf_dashboardlinks_';

    public function beforeSave()
    {
        $user = BackendAuth::getUser();
        $this->recorded_by = $user->id;
    }
}