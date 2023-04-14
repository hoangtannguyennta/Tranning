<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drinking extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "drinking";

    protected $fillable = [
        'name',
    ];

    public function drinkingPubs()
    {
        return $this->belongsToMany('App\Models\Pub', 'drinking_pubs', 'drinking_id', 'pubs_id')
        ->withPivot('amount')
        ->withTimestamps();
    }
}
