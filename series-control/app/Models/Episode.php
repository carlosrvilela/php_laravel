<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = ['number'];
    protected $casts = ['watched' => 'boolean'];
    public $timestamps = false;

    public function season(){
        return $this->belongsTo(Season::class);
    }
}
