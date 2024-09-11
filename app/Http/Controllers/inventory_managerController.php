<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Expense;
use App\Models\products;
use App\Models\purchases;
use Carbon\Carbon;
use Illuminate\Http\Request;

class inventory_managerController extends Controller
{
    public function index(request $request){
        $search = $request->search;
        $categoryButton = $request->category;
        $category = category::where('admin_id',auth()->user()->admin_id)->get();
        if($search){
            $products = products::where('admin_id',auth()->user()->admin_id)->where('name','LIKE',"%$search%")->orwhere('price','LIKE',"%$search%")->get();
            $categories = null;
        }else{
            if($categoryButton){
                $categories = category::where('admin_id',auth()->user()->admin_id)->where('id',$categoryButton)->with('products')->get();
            }else{
                $categories = category::where('admin_id',auth()->user()->admin_id)->with('products')->get();
            }
            $products = null;
        }
        return view('inventory_manager', compact('categories','products','search','category'));
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
    public function purchases(Request $request){
            $total_purchased = 0;
            $ids = $request->input('product_id');
            $purchasePrices = $request->input('NewPrice');
            $quantities = $request->input('quantity');
            foreach($quantities as $identifier => $quantity){
                $product_id = $ids[$identifier];
                $product = products::findOrFail($product_id);
                $oldPrice = $product->price;
                $purchasePrice = $purchasePrices[$identifier];
                $sellingPrice = $purchasePrice + ($purchasePrice * $product->markup / 100);
                $product->price = $sellingPrice;
                $quantity_result = $product->quantity + ($quantity);
                $product->quantity = $quantity_result;

                $product_stored = $product->save();
                $total =$purchasePrice*((int)$quantity);
                $expenses = Expense::create([
                    'admin_id' => auth()->user()->admin_id,
                    'category' => 'Purchase',
                    'amount' => $total,
                ]);
                $purchases_stored = purchases::create([
                    'admin_id' => auth()->user()->admin_id,
                    'inventory_manager_id' => auth()->user()->id, 
                    'total_amount' => $total, 
                    'product_id' => $product_id,
                    'price' => $sellingPrice, 
                    'oldPrice' => $oldPrice, 
                    'markup' => $product->markup, 
                    'quantity' => $quantity,
                ]);
                if($purchases_stored && $product_stored && $expenses){
                    $total_purchased += 1;
                }else{
                    return redirect('/inventory_manager/dashboard')->with('message',['status'=>'Operation failed','bootstrap_class'=>'alert alert-danger']);
                }
            }
        return redirect('/inventory_manager/dashboard')->with('message',['status'=>"$total_purchased ".'products purchased','bootstrap_class'=>'alert alert-success']);
    }
    public function records(request $request){
        if($request->date){
            $search = $request->date;
            $purchases = purchases::where('admin_id',auth()->user()->admin_id)->with('product')->where('created_at','LIKE',"%$search%")
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->orderBy('created_at','desc')
            ->get();
        }else{
            $purchases = purchases::where('admin_id',auth()->user()->admin_id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30)->toDateString())
            ->whereDate('created_at', '<=', Carbon::now()->toDateString())
            ->with('product')->orderBy('created_at','desc')
            ->get();
        }
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
        return view('inventory_manager_records', compact('groupedPurchasesWithTotal'));


    }
    
    function create(request $request){
        if(is_null($request->category) && is_null($request->newCategory)){
            return redirect()->route('admin.dashboard')->with('message',['status'=>'please select or create category','bootstrap_class'=>'alert alert-danger']);
        }else{
            $categories = category::where('id' ,'=', $request->category)->exists();
            $admin_id = auth()->user()->admin_id;
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
                'admin_id'=> $admin_id ?? 1,
                'category_id'=> $category_id,
                'usage'=> 0,
                'markup'=> 10,
                'price'=> $request->price,
                'quantity'=> $request->quantity,
            ]);
            if($product){
                return redirect()->route('inventory_manager.dashboard')->with('message',['status'=>'successfully operation done','bootstrap_class'=>'alert alert-success']);
            }else{
                return redirect()->route('inventory_manager.dashboard')->with('message',['status'=>'something went wrong','bootstrap_class'=>'alert alert-danger']);
            }
        }
    }

    public function edit($id){
        $product = products::findOrFail($id);
        return redirect()->route('inventory_manager.dashboard')->with('edit_product',['product'=>$product,'bootstrap_class'=>'alert alert-primary']);
    }
    
    public function update(request $request){
        $id = $request->id;
        $product = products::findOrFail($id);

        $category = $request->category;
        $name = $request->name;
        $quantity = $request->quantity;
        $price = $request->price;
        $update = $product->update([
            'manager_id'=>auth()->user()->id,
            'name'=>$name,
            'quantity'=>$quantity,
            'category'=>$category,
            'price'=>$price,
        ]);
        if($update){
            return redirect()->route('inventory_manager.dashboard')->with('message',['status'=>'successfully product updated','bootstrap_class'=>'alert alert-success']);
        }else{
            return redirect()->route('inventory_manager.dashboard')->with('message',['status'=>'failed oparation','bootstrap_class'=>'alert alert-danger']);
        }
    }

}
