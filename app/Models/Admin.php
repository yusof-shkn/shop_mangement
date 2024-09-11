<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = ['user_id'];
    
    public function category(){
        return $this->hasMany(category::class);
    }
    public function employees(){
        return $this->hasMany(employees::class);
    }
    public function products(){
        return $this->hasMany(products::class);
    }
    public function purchases(){
        return $this->hasMany(purchases::class);
    }
    public function sales(){
        return $this->hasMany(sales::class);
    }
    public function roles(){
        return $this->hasMany(roles::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function incomes(){
        return $this->hasMany(Income::class);
    }
    public function expenses(){
        return $this->hasMany(Expense::class);
    }
}
