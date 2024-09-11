<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = ['admin_id','name','hourly_rate','role','phone_number'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function service_manager(){
        return $this->hasMany(sales::class,'service_manager_id','id');
    }
    public function inventory_manger(){
        return $this->hasMany(purchases::class,'inventory_manager_id','id');
    }
    public function shifts(){
        return $this->hasMany(Shift::class,'employee_id','id');
    }
    public function salaries(){
        return $this->hasMany(Salary::class,'employee_id','id');
    }
}
