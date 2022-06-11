<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circulation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['collection', 'member'];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('transaction_code', 'like', '%' . $search . '%');
            })->orWhereHas('member.user', function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('collection', function($query) use ($search) {
                $query->where('collection_code', 'like', '%' . $search . '%');
            })->orWhereHas('collection.bibliography', function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['duration'] ?? false, function($query, $duration) {
            return $query->where(function($query) use ($duration) {
                $query->where('duration', 'like', '%' . $duration . '%');
            });
        });

        $query->when($filters['status'] ?? false, function($query, $status) {
            return $query->where(function($query) use ($status) {
                $query->where('status', 'like', '%' . $status . '%');
            });
        });

        $query->when($filters['borrowed_date'] ?? false, function($query, $borrowed_date) {
            return $query->where(function($query) use ($borrowed_date) {
                $query->where('borrowed_date', 'like', '%' . $borrowed_date . '%');
            });
        });

        $query->when($filters['return_deadline'] ?? false, function($query, $return_deadline) {
            return $query->where(function($query) use ($return_deadline) {
                $query->where('return_deadline', 'like', '%' . $return_deadline . '%');
            });
        });

        $query->when($filters['returned_date'] ?? false, function($query, $returned_date) {
            return $query->where(function($query) use ($returned_date) {
                $query->where('returned_date', 'like', '%' . $returned_date . '%');
            });
        });
    }

    public function collection() {
        return $this->belongsTo(Collection::class);
    }

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
