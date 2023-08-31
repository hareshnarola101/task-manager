<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Task;

/**
 * Class Project
 * @package App\Models
 * @version August 2, 2023, 8:15 am UTC
 *
 * @property string $name
 */
class Project extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'projects';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    
}
