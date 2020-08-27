<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin(Request $request)
    {
        return view('admin');
    }


    /**
     * Show the Products dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function products(Request $request)
    {
        return view('products');
    }


    /**
     * Load Products from DB.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadProducts()
    {
        $products = Product::select('name', 'id', 'price', 'quantity')->latest()->get();

        return response()->json($products, 200);
    }


    /**
     * Search for Products from DB.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchProducts(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->name . '%')
            ->orWhere('price', $request->price)
            ->orWhere('quantity', $request->quantity)
            ->latest()
            ->get();

        return response()->json($products, 200);
    }



    /**
     * Save Order to DB.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrCreateProduct(Request $request)
    {

        $this->validate($request, [
            'name'  =>  'required|min:2|max:250',
            'price' =>  'required|min:1',
            'quantity'  =>  'required|min:1'
        ]);

        $product = Product::updateOrCreate(
            ['id'   =>  $request->id],
            [
                'name'  =>  $request->name,
                'price'  =>  $request->price,
                'quantity'  =>  $request->quantity,
            ]
        );

        return response()->json($product, 200);
    }


    /**
     * Load Orders from DB.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadOrders()
    {
        $orders = Order::with('items', 'items.product:id,name')->latest()->get();

        return response()->json($orders, 200);
    }


    /**
     * Search for Orders from DB.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchOrders(Request $request)
    {
        $query = Order::latest();
        if ($request->name)
            $query = $query->where('client_name', 'LIKE', '%' . $request->name . '%');

        if ($request->price)
            $query = $query->where('price', $request->price);

        if ($request->date)
            $query = $query->whereDate('created_at', $request->date);

        $orders = $query->get();

        return response()->json($orders, 200);
    }
}
