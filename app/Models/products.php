<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['admin_id','name','category_id','price','markup','quantity','usage'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function sales(){
        return $this->hasMany(sales::class);
    }

    public function purchases(){
        return $this->hasMany(purchases::class);
    }

    public function category(){
        return $this->belongsTo(category::class);
    }
}
