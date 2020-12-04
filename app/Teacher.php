<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable =['nama','nip','alamat'];

    public function makul()
    {
    	return $this->hasMany(Makul::class);
    }
}
