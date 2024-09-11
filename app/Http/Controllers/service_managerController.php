<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Income;
use App\Models\products;
use App\Models\sales;
use Illuminate\Http\Request;
use Carbon\Carbon;
class service_managerController extends Controller
{
    public function index(request $request){
        $search = $request->search;
        $categoryButton = $request->category;
        $category = category::all();
        if($search){
            $products = products::where('admin_id',auth()->user()->admin_id)->where('name','LIKE',"%$search%")->orwhere('price','LIKE',"%$search%")->get();
            return view('service_manager', compact('products','search','category'));
        }else{
            if($categoryButton){
                $categories = category::where('admin_id',auth()->user()->admin_id)->where('name','=',$categoryButton)->with('products')->get();
            }else{
                $categories = category::where('admin_id',auth()->user()->admin_id)->with('products')->get();}
            return view('service_manager', compact('categories','search','category'));
        }
    }
    public function search(Request $request)
    {
        $output = "";
        $searchValue = $request->search;
        $results = products::where('admin_id',auth()->user()->admin_id)->where('name','LIKE',"%$searchValue%")->orwhere('price','LIKE',"%$searchValue%")->paginate(10);
        foreach($results as $x){
            if($x->quantity == 0){
                $disabled = ";background-color: #c3c3bd; color: #737370;border-bottom:solid 4px black;";
            }else{
                $disabled = '' ;
            }
            $output.="
            <table class='w-100 table-sm table-hover rounded mb-2' style='user-select: none;background-color:#ffff ;font-size:13px;box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;font-family:roboto; color: black; border-bottom:solid 4px #011dce; font-weight:500; $disabled '>
                <tr onclick=".'"'."showItemInfo('$x->name','$x->price','$x->id','$x->quantity')".'"'." >
                    <td class=' px-3 py-2'>$x->name</td>
                    <td class=' px-3 py-2'>$x->price$</td>
                    <td class=' px-3 py-2 '>$x->quantity unit</td>
                </tr>
            </table>";
        }
        return response($output);
    }
    public function sales(Request $request){
        $ids = $request->product_id;
        $quantities = $request->quantity;
        $total_sold = 0;
        foreach($quantities as $identifier => $quantity){
            $product_id = $ids[$identifier];
            $product = products::findOrfail($product_id);
            $newUsage = min($product->usage + ($quantity) , 100);
            $quantity_result = $product->quantity - ($quantity);
            if($quantity_result < 0){
                return redirect('/service_manager/dashboard')->with('message',['status'=>'sorry out of product quantity limit','bootstrap_class'=>'alert alert-danger']);
            }
            $product->usage = $newUsage;
            $product->quantity = $quantity_result;
            $total_amount = $product->price*((int)$quantity);
            $icomes = Income::create([
                'admin_id' => auth()->user()->admin_id,
                'category' => 'Sales',
                'amount' => $total_amount,
            ]);
            $sales_stored = sales::create([
                'admin_id' => auth()->user()->admin_id, 
                'service_manager_id' => auth()->user()->id, 
                'total_amount' => $total_amount, 
                'product_id' => $product_id,
                'price' => $product->price, 
                'quantity' => $quantity,
            ]);
            $product_stored = $product->save();
            if($sales_stored && $product_stored && $icomes){
                $total_sold+=1;
            }else{
                return redirect('/service_manager/dashboard')->with('message',['status'=>'Operation failed','bootstrap_class'=>'alert alert-danger']);
            }
        }
        return redirect('/service_manager/dashboard')->with('message',['status'=>"$total_sold ".'products sold','bootstrap_class'=>'alert alert-success']);
    }
    public function records(request $request){
        if($request->date){
            $search = $request->date;
            $sales = sales::where('admin_id',auth()->user()->admin_id)->with('product')->where('created_at','LIKE',"%$search%")
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->orderBy('created_at','desc')
            ->get();
        }else{
            $sales = sales::where('admin_id',auth()->user()->admin_id)->with('product')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->orderBy('created_at','desc')
            ->get();
        }
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
        return view('service_manager_records', compact('groupedSalesWithTotal'));
    }
}
