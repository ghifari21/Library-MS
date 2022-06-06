<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('category_code', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%');
            });
        });
    }

    public function bibliography() {
        return $this->hasMany(Bibliography::class);
    }
}
