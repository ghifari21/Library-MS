<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bibliography() {
        return $this->belongsTo(Bibliography::class);
    }

    public function circulation() {
        return $this->hasMany(Circulation::class);
    }
}
