<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = ['total_amount','product_id','price','quantity','admin_id','service_manager_id'];
    
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function product(){
        return $this->belongsTo(products::class);
    }
    public function employee(){
        return $this->belongsTo(employees::class,'service_manager_id','id');
    }
}
