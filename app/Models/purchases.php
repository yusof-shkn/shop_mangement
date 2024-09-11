<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchases extends Model
{
    use HasFactory;
    protected $table = 'purchases';
    protected $fillable = ['total_amount','product_id','oldPrice','markup','price','quantity','admin_id','inventory_manager_id'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function product(){
        return $this->belongsTo(products::class);
    }
    public function employee(){
        return $this->belongsTo(employees::class,'inventory_manager_id','id');
    }
    
}
