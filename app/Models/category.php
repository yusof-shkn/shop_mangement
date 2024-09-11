<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $fillable = ['name','admin_id'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function products(){
        return $this->hasMany(products::class);
    }
}
