<?php

namespace App\Http\Controllers;

use App\Models\cabalCash;
use App\Models\cabalCashLog;
use App\Models\ShopCategory;
use App\Models\ShopProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(Request $request, int $id)
    {
        // cash account
        $cash = cabalCash::where('ID', Auth::user()->ID)
                ->where('UserNum', Auth::user()->UserNum)
                ->first();

        // all category
        $categorys = ShopCategory::all();

        // all products
        $products = ShopProducts::where('ProductCategoryID', $id)
                    ->where('Stock', '>' , 0)
                    ->get();

        if($products->isEmpty())
        {
            return redirect()->back()->with('error', 'Pagina não existe!');
        }

        $page = $id;
        $categoryName = ShopCategory::where('ProductCategoryID', $id)->first();

        return view('painel.pages.shop.index', compact('cash', 'categorys', 'products', 'page', 'categoryName'));
    }

    public function cart()
    {
        return view('painel.pages.shop.cart');
    }

    public function addToCart($id)
    {
        $product = ShopProducts::where('ProductID', $id)->first();

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "Name"          => $product->Name,
                "ProductID"     =>  $product->ProductID,
                "description"   => $product->Description,
                "quantity"      => 1,
                "price"         => $product->Price,
                "image"         => $product->Image,
                "time"          => $product->Duration
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produto adicionado no carrinho com sucesso!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart atualizado com sucesso!');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Produto removido com sucesso');
        }
    }

    public function buyProduct(Request $request)
    {
        $cart = session()->get('cart');
        if($cart)
        {
            $products = session()->get('cart');
            $total = 0;

            $cash = cabalCash::where('ID', Auth::user()->ID)
                                ->where('UserNum', Auth::user()->UserNum)
                                ->first();
            // produtos
            foreach ($products as $key => $product)
            {

                $total += $product['price'] * $product['quantity']; // preço total dos produtos

                $product_item = ShopProducts::where('ProductID', $product['ProductID'])->first(); // pegando dados do produto

                // check cash player se tem limite
                if($cash->Cash < $total)
                {
                    return response()->json([
                        'error' => true,
                        'message' => "Desculpe, Mas você não possui Cash suficiente!",
                    ]);
                }
                // check quantidade
                if($product['quantity'] <= 0 || $product['quantity'] > 10)
                {
                    return response()->json([
                        'error' => true,
                        'message' => "Unidade excedida, você pode comprar no minimo 1 ou no máximo 10 unidades!",
                    ]);
                }
                // check stock item
                if($product['quantity'] > $product_item->Stock)
                {
                    return response()->json([
                        'error' => true,
                        'message' => "Ops! esse item só existe '.$product_item->Stock.' Unidades, Por Favor Volte a Compra e Digite Somente a Quantidade que ainda existe..",
                    ]);
                }

                // check time item
                if($product['time'] <> $product_item->Duration)
                {
                    return response()->json([
                        'error' => true,
                        'message' => "Tentar burlar o sistema é crime. Seus dados foram gravados. :)",
                    ]);
                }
                // update dados  produto
                $product_item_up = ShopProducts::firstOrNew(['ProductID'=> $product['ProductID']]);
                $product_item_up->Stock     = $product_item->Stock - $product['quantity']; // stock do produto
                $product_item_up->QntVend   = $product_item->QntVend + $product['quantity']; // add quantidade vendidas
                $product_item_up->save(); // save atualizações

                // cash total
                $valorCash = $cash->Cash - $total;
                // descont cash
                cabalCash::where('ID', Auth::user()->ID)
                            ->where('UserNum', Auth::user()->UserNum)
                            ->update(['Cash' => $valorCash]);
                // add cash log
                $data = [
                    'usernum'       => Auth::user()->UserNum,
                    'purchasedate'  => Carbon::today(),
                    'itemnum'       => $product_item->Name,
                    'durationidx'   => $product['time'],
                    'quantity'      => $product['quantity'],
                    'PriceCoin'     => $total,
                    'PricePoint'    => 0,
                    'Para'          => Auth::user()->ID,
                ];

                cabalCashLog::create($data); // add log cash

                $account = Auth::user(); // get user infos

                // send itens
                for ($i=1; $i <= $product['quantity']; $i++)
                {
                    DB::update(
                        DB::raw("USE [CabalCash]exec  up_AddMyCashItemByItem '".$account->UserNum."', '1', '1', '".$product_item->ItemIDX."', '".$product_item->OptionIDX."', '".$product_item->Duration."' ")
                    );
                }

                // remove itens cart
                if(isset($cart[$key])) {
                    unset($cart[$key]);
                    session()->put('cart', $cart);
                }

            }

            return response()->json([
                'success' => true,
                'message' => "Item(s) comprado com sucesso - Cabal Hype!",
            ]);
        }
    }
}
