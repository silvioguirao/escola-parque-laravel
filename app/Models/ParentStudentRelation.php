<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentStudentRelation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['parent_id', 'enrollment_id', 'relationship'];
    
    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }
    
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
