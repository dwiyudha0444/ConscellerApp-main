<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;
    protected $table = 'portofolios';
    protected $fillable = [
        'user_id', 'name', 'photo', 'url','tgl1','tgl2','tgl3','tgl4','jdwl','jdwl2','jdwl3','jdwl4'
    ];

    public function portofolioImage()
    {
        return $this->hasMany(PortofolioImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function experience()
    {
        return $this->hasOne(Experience::class);
    }
}
