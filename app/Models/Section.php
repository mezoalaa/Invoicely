<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{

    use HasFactory , SoftDeletes ;
    protected $table = 'sections';

    protected $fillable = [
        'section_name',
        'description',
        'Created_by',
    ];
    protected $dates = ['deleted_at']; // Specify the deleted_at field

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
