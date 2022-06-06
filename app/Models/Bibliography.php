<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibliography extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('book_code', 'like', '%' . $search . '%')->orWhere('isbn', 'like', '%' . $search . '%')->orWhere('title', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['language'] ?? false, function($query, $language) {
            return $query->where(function($query) use ($language) {
                $query->where('language', 'like', '%' . $language . '%');
            });
        });

        $query->when($filters['published_year'] ?? false, function($query, $published_year) {
            return $query->where(function($query) use ($published_year) {
                $query->where('published_year', 'like', '%' . $published_year . '%');
            });
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', function($query) use ($category) {
                $query->where('category_code', $category);
            });
        });

        $query->when($filters['publisher'] ?? false, function($query, $publisher) {
            return $query->whereHas('publisher', function($query) use ($publisher) {
                $query->where('publisher_code', $publisher);
            });
        });

        $query->when($filters['author'] ?? false, function($query, $author) {
            return $query->whereHas('author', function($query) use ($author) {
                $query->where('author_code', $author);
            });
        });
    }

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
