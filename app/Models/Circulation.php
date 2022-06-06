<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circulation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function collection() {
        return $this->belongsTo(Collection::class);
    }

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
