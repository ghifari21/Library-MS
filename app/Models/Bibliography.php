<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibliography extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function collection() {
        return $this->hasMany(Collection::class);
    }

    public function publisher() {
        return $this->belongsTo(Publisher::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
