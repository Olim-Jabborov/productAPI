<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Product;

class CardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $query = Card::query();
        $query->with(["user", "product"]);
        $query->where("user_id", auth('api')->id());
        if($request->has("product_id")){
            $query->where("product_id", $request->product_id);
        }
        $cards = $query;
        return response()->json([
            'status' => 'success',
            'cards' => $cards,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::where("id", $request->product_id)->first();

        $card = Card::create([
            'product_id' => $request->product_id,
            'user_id' => auth('api')->id(),
            'quantity' => $request->quantity ?? 1,
            'total_price' => ($request->quantity ?? 1) * ($product->price)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Card created successfully',
            'card' => $card,
        ]);
    }

    public function show($id)
    {
        $card = Card::find($id);
        return response()->json([
            'status' => 'success',
            'card' => $card,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::where("id", $request->product_id)->first();
        
        $card = Card::find($id);
        $card->product_id = $request->product_id;
        if($request->has("quantity")){
            $card->quantity = $request->quantity;
            $card->total_price = $request->quantity * $product->price;
        }
        $card->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Card updated successfully',
            'card' => $card,
        ]);
    }

    public function destroy($id)
    {
        $card = Card::find($id);
        $card->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Card deleted successfully',
        ]);
    }
}
