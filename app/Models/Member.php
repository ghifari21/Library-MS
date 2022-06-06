<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user'];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('member_code', 'like', '%' . $search . '%');
            })->orWhereHas('user', function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%');
            });
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function circulation() {
        return $this->hasMany(Circulation::class);
    }
}
