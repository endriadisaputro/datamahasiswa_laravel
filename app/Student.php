<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable =['nama_depan','nama_belakang','jenis_kelamin','agama','alamat','avatar','user_id'];

    public function getAvatar(){
    	if (!$this->avatar) {	
    		return asset('images/logoPT.png');
    	} 
    		return  asset('images/'.$this->avatar);
    }

    public function makul()
    {
    	return $this->belongsToMany(Makul::class)->withPivot(['nilai'])->withTimeStamps();
    }

    public function rataRataNilai()
    {
        //ambil nilai
        $total =0;
        $hitung =0;
        if($this->makul->isNotEmpty())
        {
            foreach($this->makul as $makul)
            {
                $total += $makul->pivot->nilai;
                $hitung++;
                // return round($total / $hitung):$total;
            } 
                return $total !=0 ? round($total/$hitung):$total;

        }
    }

    public function nama_lengkap()
    {
        return $this->nama_depan .' '. $this->nama_belakang;
    }
}
