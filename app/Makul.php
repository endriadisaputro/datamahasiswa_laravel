<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makul extends Model
{
    protected $table = 'makul';
    
    protected $fillable = ['kode', 'nama', 'semester'];

    public function student()
    {
    	return $this->belongsToMany(Student::class)->withPivot(['nilai']);
    }

    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }
}
