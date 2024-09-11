<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salaries';
    protected $fillable = ['admin_id','employee_id','start_date','end_date','salary_amount'];
    
    public function employee(){
        return $this->belongsTo(employees::class,'employee_id','id');
    }
}
