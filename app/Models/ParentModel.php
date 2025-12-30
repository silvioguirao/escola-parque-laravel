<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';
    protected $fillable = ['email', 'name', 'phone', 'provider', 'provider_id', 'profile_picture', 'last_signed_in'];
    protected $casts = ['last_signed_in' => 'datetime'];
    
    public function studentRelations()
    {
        return $this->hasMany(ParentStudentRelation::class, 'parent_id');
    }
}
