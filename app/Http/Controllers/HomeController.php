<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Load Products from DB.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadProducts()
    {
        $products = Product::select('name', 'id', 'price', 'quantity')->get();

        return response()->json($products, 200);
    }


    /**
     * Save Order to DB.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveOrder(Request $request)
    {
        $order = new Order();
        $order->save();

        $total = 0;
        foreach ($request->products as $product) {

            // Calculate Total
            $total += $product['product_quantity'] * $product['product_price'];

            // Save order Item
            $order->items()->create([
                'price'     =>  $product['product_price'],
                'quantity'  =>  $product['product_quantity'],
                'product_id'    =>  $product['product_id']
            ]);

            // Minimize Product Quantity in DB
            $dbProduct = Product::find($product['product_id']);
            $dbProduct->quantity = $dbProduct->quantity - $product['product_quantity'];
            $dbProduct->save();
        }

        // Update Order with total price
        $order->price = $total;
        $order->save();

        return response()->json($order, 200);
    }
}
