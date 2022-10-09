<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cover_path'];
    protected $whith = ['seasons'];

    public function seasons()
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    protected static function booted()
    {
        self::addGlobalScope(scope: 'ordered', implementation:function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }
}
