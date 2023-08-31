<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project;

/**
 * Class task
 * @package App\Models
 * @version August 2, 2023, 8:33 am UTC
 *
 * @property integer $project_id
 * @property string $task_name
 * @property integer $priority
 */
class Task extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'tasks';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'project_id',
        'task_name',
        'priority'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'project_id' => 'integer',
        'task_name' => 'string',
        'priority' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'project_id' => 'required',
        'task_name' => 'required',
        'priority' => 'required'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    
}
