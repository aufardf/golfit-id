<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'gambar', 'description', 'qty', 'price', 'discount', 'slug','users_id'];
    protected $table = 'm_products';
    
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tags');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
