<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shifts';
    protected $fillable = ['employee_id','start_time','end_time','totalHours','totalAmount'];
    
    public function employee(){
        return $this->belongsTo(employees::class,'employee_id','id');
    }
    
}
