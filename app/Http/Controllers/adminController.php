<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\category;
use App\Models\employees;
use App\Models\Expense;
use App\Models\Income;
use App\Models\products;
use App\Models\purchases;
use App\Models\roles;
use App\Models\Salary;
use Spatie\Permission\Models\Role;
use App\Models\sales;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class adminController extends Controller
{
    public function index(request $request){

        $search = $request->search;
        $categories = category::where('admin_id', auth()->user()->id)->with('products')->get();
        if($search){
            $products = products::where('admin_id', auth()->user()->id)->where('name','LIKE',"%$search%")->orwhere('price','LIKE',"%$search%")->get();
        }else{
            $products = null;
        }
        $incomes = Income::where('admin_id', auth()->user()->id)->get();
        $chartIncomes = Income::select(DB::raw('DAY(created_at) as day'), DB::raw('SUM(amount) as total'))
        ->groupBy(DB::raw('DAY(created_at)'))
        ->pluck('total', 'day')
        ->toArray();
        $expenses = Expense::where('admin_id', auth()->user()->id)->get();
        $chartExpenses = Expense::select(DB::raw('DAY(created_at) as day'), DB::raw('SUM(amount) as total'))
        ->groupBy(DB::raw('DAY(created_at)'))
        ->pluck('total', 'day')
        ->toArray();
        $sales = sales::where('admin_id', auth()->user()->id)->sum('quantity');
        $purchases = purchases::where('admin_id', auth()->user()->id)->sum('quantity');
        $salaries = Salary::where('admin_id', auth()->user()->id);
        $employees = employees::where('admin_id',auth()->user()->id)->with('salaries')->get();
        $roles = Role::where('name', '!=', 'admin')->get();
        $roles2 = roles::where('admin_id',auth()->user()->id)->where('name', '!=', 'admin')->get();
        $users = User::where('admin_id', auth()->user()->id)->get();
        $sale_totalAmount = sales::where('admin_id',auth()->user()->id)->sum('total_amount');
        $purchase_totalAmount = purchases::where('admin_id',auth()->user()->id)->sum('total_amount');

        return view('admin',compact('chartIncomes','chartExpenses','incomes','expenses','sale_totalAmount','purchase_totalAmount','employees','roles','roles2','users','categories','search','products','sales','purchases'));
    }

    
    public function create_employee(request $request){
        if(is_null($request->role) && is_null($request->newRole)){
            return redirect()->route('admin.dashboard')->with('message',['status'=>'please select or create role','bootstrap_class'=>'alert alert-danger']);
        }else{
            $admin_id = auth()->user()->id;
            $roles1 = Role::where('id' ,'=', $request->role)->exists();
            $roles2 = roles::where('id' ,'=', $request->role)->exists();
            if($roles1){
                $old = Role::findOrFail($request->role);
                $role = $old->id;
            }elseif($roles2){
                $old = roles::findOrFail($request->role);
                $role = $old->id;
            }else{
                $new =roles::create([
                    'name'=>$request->newRole,
                    'admin_id'=>$admin_id,
                ]);
                $role = $new->id;
            }
            $employees = employees::create([
                'name'=> $request->name,
                'admin_id'=> $admin_id ?? Auth::user()->id,
                'role'=> $role,
                'hourly_rate'=> $request->hourly_rate,
                'phone_number'=> $request->phone_number,
            ]);
            if($employees){
                return redirect()->route('admin.dashboard')->with('message',['status'=>'successfully operation done','bootstrap_class'=>'alert alert-success']);
            }else{
                return redirect()->route('admin.dashboard')->with('message',['status'=>'something went wrong','bootstrap_class'=>'alert alert-danger']);
            }
        }
    }
    public function update_employee(request $request){
        $rolexists = roles::where('id',$request->role)->exists();
        if($rolexists){
            $role = roles::findOrFail($request->role);
        }else{
            $role = Role::findOrFail($request->role);
        }
        $employees = employees::where('admin_id',auth()->user()->id)->where('id','=',$request->id);
        $update = $employees->update([
        'name'=> $request->name,
        'role'=> $role->id,
        'hourly_rate'=> $request->hourly_rate,
        'phone_number'=> $request->phone_number,
        ]);
        if($update){
            return redirect()->route('admin.dashboard')->with('message',['status'=>'successfully operation done','bootstrap_class'=>'alert alert-success']);
        }else{
            return redirect()->route('admin.dashboard')->with('message',['status'=>'Operation failed','bootstrap_class'=>'alert alert-danger']);
        }
    }
    public function delete_employee(request $request){
        $confirm = $request->confirmation;
        $confirmation = strtolower($confirm);
        if($confirmation == 'confirm'){
            $id = $request->id;
            $employee = employees::findOrFail($id);
            $account = User::where('manager_id',$employee->id)->get();
            $delete_account = $account->delete();
            $deleted = $employee->delete();
            if($deleted && $delete_account){
                return redirect()->route('admin.dashboard')->with('message',['status'=>'successfully Employee deleted','bootstrap_class'=>'alert alert-success']);
            }else{
                return redirect()->route('admin.dashboard')->with('message',['status'=>'failed oparation','bootstrap_class'=>'alert alert-danger']);
            }
        }else{
            return redirect()->route('admin.dashboard')->with('message',['status'=>'operation failed','bootstrap_class'=>'alert alert-danger']);
        }
    }
    public function account_employee(request $request)
        {
        $validation = $request->validate([
            'username' => ['required', 'string', 'max:255','unique:users'],
            'password' => ['required', 'string', 'max:20','confirmed'],
            'confirmation' => ['required', 'string', 'in:confirm,Confirm,confirmed',]
        ]);
        if($validation){
            $id = $request['id'];
            $employee = employees::findOrFail($id);
            $account = User::create([
                'name' => $employee->name,
                'username' => $request['username'],
                'email' => auth()->user()->email,
                'admin_id' => auth()->user()->id,
                'manager_id' => $employee->id,
                'email_verified_at' => now(),
                'role' => $employee->role,
                'password' => Hash::make($request['password']),
            ]);
            if($account){
                return redirect()->route('admin.dashboard')->with('message',['status'=>'successfully Account Created','bootstrap_class'=>'alert alert-success']);
            }else{
                return redirect()->route('admin.dashboard')->with('message',['status'=>'failed oparation','bootstrap_class'=>'alert alert-danger']);
            }
        }else{
            return redirect()->route('admin.dashboard')->with('message',['status'=>'the inputs you filled are invalid','bootstrap_class'=>'alert alert-danger']);
        }
    }


    // product functions

    function create_product(request $request){
        if(is_null($request->category) && is_null($request->newCategory)){
            return redirect()->route('admin.dashboard')->with('message',['status'=>'please select or create category','bootstrap_class'=>'alert alert-danger']);
        }else{
            $categories = category::where('id' ,'=', $request->category)->exists();
            $admin_id = auth()->user()->id;
            if($categories){
                $categoryID = category::findOrFail($request->category);
                $category_id = $categoryID->id;
            }else{
                $category = $request->newCategory;
                $new = category::create([
                    'name'=>$category,
                    'admin_id'=>$admin_id,
                ]);
                $category_id = $new->id;
            }
            $product = products::create([
                'name'=> $request->name,
                'admin_id'=> $admin_id ?? Auth::user()->id,
                'category_id'=> $category_id,
                'usage'=> 0,
                'markup'=> 10,
                'price'=> $request->price,
                'quantity'=> $request->quantity,
            ]);
            if($product){
                return redirect()->route('admin.dashboard')->with('message',['status'=>'successfully operation done','bootstrap_class'=>'alert alert-success']);
            }else{
                return redirect()->route('admin.dashboard')->with('message',['status'=>'something went wrong','bootstrap_class'=>'alert alert-danger']);
            }
        }
    }
    
    function update_product(request $request){
        $category = category::where('id',$request->category)->first();
        $product = products::where('admin_id',auth()->user()->id)->where('id','=',$request->id);
        $update = $product->update([
        'name'=> $request->name,
        'category_id'=> $category->id,
        'price'=> $request->price,
        'quantity'=> $request->quantity,
        ]);
        if($update){
            return redirect()->route('admin.dashboard')->with('message',['status'=>'successfully operation done','bootstrap_class'=>'alert alert-success']);
        }else{
            return redirect()->route('admin.dashboard')->with('message',['status'=>'Operation failed','bootstrap_class'=>'alert alert-danger']);
        }
    }
    function delete_product(request $request){
        $confirm = $request->confirmation;
        $confirmation = strtolower($confirm);
        if($confirmation == 'confirm'){
            $id = $request->id;
            $product = products::findOrFail($id);
            $deleted = $product->delete();
            if($deleted){
                return redirect()->route('admin.dashboard')->with('message',['status'=>'successfully Product deleted','bootstrap_class'=>'alert alert-success']);
            }else{
                return redirect()->route('admin.dashboard')->with('message',['status'=>'failed oparation','bootstrap_class'=>'alert alert-danger']);
            }
        }else{
            return redirect()->route('admin.dashboard')->with('message',['status'=>'please type `confirm` correctly to delete product','bootstrap_class'=>'alert alert-danger']);
        }
    }
    function show_products($id){
        if(is_null($id)){
            return redirect()->route('admin.dashboard')->with('message',['status'=>'something went wrong']);
        }else{
            $total_sales = sales::where('product_id',$id)->sum('price');
            $total_sales_quantity = sales::where('product_id',$id)->sum('quantity');
            $product = sales::where('product_id', $id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->get('price');

            $chartData = [];
            foreach ($product as $sale) {
                $chartData[] = ['y' => $sale->price];
            }

            $total_purchases = purchases::where('product_id',$id)->sum('price');
            $total_purchases_quantity = purchases::where('product_id',$id)->sum('quantity');
            $product = purchases::where('product_id', $id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->get('price');

            $PurchasedChartData = [];
            foreach ($product as $purchase) {
                $PurchasedChartData[] = ['y' => $purchase->price];
            }
            $product = products::findOrFail($id);
            return view('admin_products', compact('chartData','product','PurchasedChartData','total_sales','total_sales_quantity','total_purchases','total_purchases_quantity'));
        }
    }

    public function update_product_markup(request $request){
        if($request->confirmation == 'confirm'){
            $product = products::findOrFail($request->id);
            $product->markup = $request->markup;
            $product->save();

            return redirect()->route('admin.dashboard')->with('message',['status'=>'successfully markup updated','bootstrap_class'=>'alert alert-success']);
        }else{
            return redirect()->route('admin.dashboard')->with('message',['status'=>'please type `confirm` correctly to update markup','bootstrap_class'=>'alert alert-danger']);
        }
    }

    public function purchases(request $request){
        if($request->date){
            $search = $request->date;
            $purchases = purchases::where('admin_id',auth()->user()->id)->with('product')->where('created_at','LIKE',"%$search%")
            ->with('employee')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->orderBy('created_at','desc')
            ->get();
            $groupedPurchases = $purchases->groupBy(function ($sale) {
                return Carbon::parse($sale->created_at)->format('Y-m-d H:i');
            });
            $groupedPurchasesWithTotal = $groupedPurchases->map(function ($group){
                $total_amount = $group->sum('total_amount');
                return [
                    'purchases'=>$group,
                    'total_amount'=>$total_amount,
                ];
            });
        }else{
            $purchases = purchases::where('admin_id',auth()->user()->id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->with('employee')
            ->with('product')->orderBy('created_at','desc')
            ->get();
            $groupedPurchases = $purchases->groupBy(function ($sale) {
                return Carbon::parse($sale->created_at)->format('Y-m-d H:i');
            });
            $groupedPurchasesWithTotal = $groupedPurchases->map(function ($group){
                $total_amount = $group->sum('total_amount');
                return [
                    'purchases'=>$group,
                    'total_amount'=>$total_amount,
                ];
            });
        }
        return view('admin_purchases', compact('groupedPurchasesWithTotal'));
    }

    public function sales(request $request){
        if($request->date){
            $search = $request->date;
            $sales = sales::where('admin_id',auth()->user()->id)->with('product')->where('created_at','LIKE',"%$search%")
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->with('product')->with('employee')
            ->orderBy('created_at','desc')
            ->get();
            $groupedSales = $sales->groupBy(function ($sale) {
                return Carbon::parse($sale->created_at)->format('Y-m-d H:i');
            });
            $groupedSalesWithTotal = $groupedSales->map(function ($group){
                $total_amount = $group->sum('total_amount');
                return [
                    'sales'=>$group,
                    'total_amount'=>$total_amount,
                ];
            });
        }else{
            $sales = sales::where('admin_id',auth()->user()->id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->with('product')->with('employee')
            ->orderBy('created_at','desc')
            ->get();
            $groupedSales = $sales->groupBy(function ($sale) {
                return Carbon::parse($sale->created_at)->format('Y-m-d H:i');
            });
            $groupedSalesWithTotal = $groupedSales->map(function ($group){
                $total_amount = $group->sum('total_amount');
                return [
                    'sales'=>$group,
                    'total_amount'=>$total_amount,
                ];
            });
        }
        return view('admin_sales', compact('groupedSalesWithTotal'));
    }


    public function shifts($id){
        $shifts = Shift::where('admin_id',auth()->user()->id)
        ->where('employee_id',$id)
        ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
        ->whereDate('created_at', '<=', Carbon::now()->toDateString())
        ->with('employee')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin_employee_shifts',compact('shifts'));
    }
    function delete_shift(request $request){
        $confirm = $request->confirmation;
        $confirmation = strtolower($confirm);
        if($confirmation == 'confirm'){
            $id = $request->id;
            $shift = Shift::findOrFail($id);
            $deleted = $shift->delete();
            if($deleted){
                return redirect()->back()->with('message',['status'=>'successfully shift deleted','bootstrap_class'=>'alert alert-success']);
            }else{
                return redirect()->back()->with('message',['status'=>'failed oparation','bootstrap_class'=>'alert alert-danger']);
            }
        }else{
            return redirect()->back()->with('message',['status'=>'please type `confirm` correctly to delete shift','bootstrap_class'=>'alert alert-danger']);
        }
    }
    function employee_salary(request $request){
        $confirm = $request->confirmation;
        $confirmation = strtolower($confirm);
        if($confirmation == 'confirm'){
            $id = $request->id;
            $salary = Salary::create([
                'admin_id'=> auth()->user()->id,
                'employee_id'=>$id,
                'start_date'=>Carbon::now()->subDay(30)->toDateString(),
                'end_date'=>Carbon::now()->toDateString(),
                'salary_amount'=>$request->totalAmount,
            ]);
            $expenses = Expense::create([
                'admin_id' => auth()->user()->admin_id,
                'category' => 'Purchase',
                'amount' => $request->totalAmount,
            ]);
            if($salary && $expenses){
                return redirect()->back()->with('message',['status'=>'successfully salary submited','bootstrap_class'=>'alert alert-success']);
            }else{
                return redirect()->back()->with('message',['status'=>'failed oparation','bootstrap_class'=>'alert alert-danger']);
            }
        }else{
            return redirect()->back()->with('message',['status'=>'please type `confirm` correctly to submit salary','bootstrap_class'=>'alert alert-danger']);
        }
    }
    public function salaries(request $request){
        $employee = employees::where('name',$request->search)->first();
        if($employee){
            $salaries = $employee->salaries()->where('admin_id',auth()->user()->id)
            ->whereDate('created_at', '>=', Carbon::now()->subYear(1)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->with('employee')->orderBy('created_at','desc')
            ->get();
        }else{
            $salaries = Salary::where('admin_id',auth()->user()->id)
            ->whereDate('created_at', '>=', Carbon::now()->subYear(1)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->with('employee')->orderBy('created_at','desc')
            ->get();
        }
        return view('admin_salaries',compact('salaries'));
    }
    public function delete_salary(request $request){
        $salary = Salary::findOrFail($request->id);
        $salary->delete();
        if($salary){
            return redirect()->back()->with('message',['status'=>'successfully Salary deleted','bootstrap_class'=>'alert alert-success']);
        }else{
            return redirect()->back()->with('message',['status'=>'failed oparation','bootstrap_class'=>'alert alert-danger']);
        }
    }
}

