<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'isbn', 'title', 'author', 'publisher', 'year_published', 'cover',
        'description', 'total_owned', 'total_borrow',
        'created_by', 'updated_by', 'deleted_by'
    ];

    public function getCoverAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }
        if (filter_var($value, FILTER_VALIDATE_URL) === false) {
            return Storage::url($value);
        } else {
            return $value;
        }
    }

    public function stock() {
        return $this->total_owned - $this->total_borrow;
    }
}
