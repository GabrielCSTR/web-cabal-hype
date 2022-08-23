<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonatePlanRequest;
use App\Http\Requests\ShopCategoryRequest;
use App\Http\Requests\ShopItemRequest;
use App\Models\Plans;
use App\Models\ShopCategory;
use App\Models\ShopProducts;
use App\Models\Transations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function indexCategory()
    {
        $categorys = ShopCategory::all();

        return view('painel.admin.shop.category', compact('categorys'));
    }

    public function addCategory(ShopCategoryRequest $request)
    {
        $data = [
            'Name'      => $request->Name,
            'News'      => $request->news1 == 'on' ? 1 : 0,
            'Active'    => $request->active1 == 'on' ? 1 : 0,
        ];

        $category = ShopCategory::create($data);

        if($category)
        {
            return back()->with('success', 'Nova categoria foi adicionada com sucesso!');
        }

        return back()->with('error', 'Falha ao adicionar nova categoria!');
    }

    public function deleteCategory(Request $request)
    {
        $delete = Shopcategory::where('ProductCategoryID', $request->category)->delete();

        return response()->json([
            'success' => true,
            'message' => "Categoria deletada com sucesso",
        ]);
    }


    public function indexItems()
    {
        $categorys = ShopCategory::all();

        $products = ShopProducts::all();

        return view('painel.admin.shop.items', compact('categorys', 'products'));
    }

    public function addItem(ShopItemRequest $request)
    {
        // $image =  time().'.'.$request->Image->extension();

        // $request->Image->store('images');
        $file       = $request->file('Image'); // get the validated file
        $extension  = $file->getClientOriginalExtension();
        $filename   = 'shop-item-' . time() . '.' . $extension;

        $file->storeAs('public/shop/images', $filename); // salve file

        // Storage::put('images/'+ $image, $request->Image);
        $data = [
            'Name'              => $request->Name,
            'Description'       => $request->Description,
            'ItemIDX'           => $request->ItemIDX,
            'OptionIDX'         => $request->OptionIDX,
            'Duration'          => $request->Duration,
            'Image'             => $filename,
            'Stock'             => $request->Stock,
            'Price'             => $request->Price,
            'ProductCategoryID' => $request->category,
            'Destaque'          => $request->destaque1 ? 0 : 1,
        ];

        $products = ShopProducts::create($data);

        if($products)
        {
            return back()->with('success', 'Nova produto foi adicionado com sucesso!');
        }

        return back()->with('error', 'Falha ao adicionar novo produto!');
    }

    public function deleteItem(Request $request)
    {
        $delete = ShopProducts::where('ProductID', $request->productID)->delete();

        return response()->json([
            'success' => true,
            'message' => "Produto removido com sucesso",
        ]);
    }

    public function indexTransations()
    {
        $shopLogsTransations = Transations::all();

        return view('painel.admin.shop.transations', compact('shopLogsTransations'));
    }

    public function donatePlans()
    {
        $plans = Plans::all();

        return view('painel.admin.donate.index', compact('plans'));
    }

    public function donatePlanStore(DonatePlanRequest $request)
    {

        $plan = Plans::updateOrCreate([
            'Name'                      =>  $request->name,
            'Price'                     =>  $request->price,
            'Cash'                      =>  $request->cash,
            'Status'                    =>  $request->status == 'on' ? 1 : 0,
        ]);

        if($plan)
        {
            return response()->json([
                'success' => true,
                'message' => "Novo Plano foi adicionado com sucesso!",
            ]);
        }
    }

    public function donatePlanDestroy(Request $request, int $id)
    {
        $plan = Plans::find($id);
        $plan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Plano foi removido com sucesso!',
        ]);
    }
}
