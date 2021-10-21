<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Item;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function AddCart(Request $request)
    {
        if (auth('sanctum')->check() == true) {

            $userId = $request->user()->id;

            //validation
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer',
                'quantity' => 'required|integer'
            ]);

            if ($validator->fails()) {
                Log::error($validator->errors());
                return response()->json($validator->errors());
            }

            $Items = Item::where('id', $request->id)->get();

            //check items
            if (count($Items) < 1) {
                Log::debug("data item not found when add to cart");

                return response()->json([
                    'status' => ['code' => 304, "response" => "Failed", "message" => "data item not found."],
                    'result' => [],
                ]);
            }

            //check qty
            $is_checkout = false;

            $qty    = $Items[0]['quantity'];
            $enble  = $Items[0]['is_enable'];

            if ($qty < 1 || $enble == false) {
                $is_checkout = false;
                Log::debug("quantity not enough or saleable when add to cart");

                return response()->json([
                    'status' => ['code' => 202, "response" => "Failed", "message" => "quantity not enough or not saleable."],
                    'result' => [],
                ]);
            }

            //check again qty request with stock
            $checkStock = $qty - $request->quantity;

            if ($checkStock < 0) {
                Log::debug("quantity not enough when add to cart");

                return response()->json([
                    'status' => ['code' => 202, "response" => "Failed", "message" => "not enough quantity."],
                    'result' => [],
                ]);
            }

            $is_checkout = true;
            $status =  "pending";

            //check if user have same items
            $checkCart = Cart::where('user_id', $userId)
                ->where('item_id', $request->id)
                ->where('status', 'pending')
                ->get();

            //create instance
            $cart       =  new Cart();
            $results    = [];

            //check if cart with duplicate sku
            if (count($checkCart) < 1) {
                $totalAmount = $qty * $Items[0]['price'];

                //if qty enough and enable true
                $cart->name             = $Items[0]['name'];
                $cart->description      = $Items[0]['description'];
                $cart->sku              = $Items[0]['sku'];
                $cart->item_id          = $Items[0]['id'];
                $cart->price            = $Items[0]['price'];
                $cart->special_price    = $Items[0]['special_price'];
                $cart->quantity         = $request->quantity;
                $cart->total_amount     = $totalAmount;
                $cart->is_checkout      = $is_checkout;
                $cart->status           = $status;
                $cart->user_id          = $userId;
                $cart->created_at       = strtotime('now');
                $cart->updated_at       = strtotime('now');

                $cart->save();

                //populate result
                $results = [
                    'status' => ['code' => 200, "response" => "Success", "message" => "Success create cart."],
                    'results' => $cart
                ];
            } else if (count($checkCart) > 0) {
                //update cart if duplicate id
                $getCart    = Cart::find($checkCart[0]['id']);
                $qty        = $getCart['quantity'] + $request->quantity;

                $totalAmount    = $getCart['price'] * $qty;

                $getCart->quantity         = $qty;
                $getCart->total_amount     = $totalAmount;

                $getCart->save();

                $results = [
                    'status' => ['code' => 200, "response" => "Success", "message" => "Success update cart."],
                    'results' => $getCart
                ];
            }

            Log::info("success add to cart : ". json_encode($results));

            return response()->json([
                $results,
            ]);
        }
    }

    public function GetAllCart(Request $request)
    {
        if (auth('sanctum')->check() == true) {
            $cart = Cart::where('user_id', $request->user()->id)
                ->where('status', 'pending')
                ->get();

            Log::info("success GetAllCart : ". json_encode($cart));

            return response()->json([
                'status' => ['code' => 200, "response" => "Success", "message" => "Success get data cart."],
                'results' => $cart
            ]);
        }
    }

    public function GetCartDetails(Request $request)
    {

        if (auth('sanctum')->check() == true) {

            $cart = Cart::where('user_id', $request->user()->id)
                ->where('id', $request->cart_id)
                ->where('status', 'pending')
                ->get();

            Log::info("success GetCartDetails : ". json_encode($cart));

            return response()->json([
                'status' => ['code' => 200, "response" => "Success", "message" => "Success get data cart detail user."],
                'results' => $cart
            ]);
        }
    }

    public function Checkout(Request $request)
    {
        //checkout must check qty first with request by user_id
        //check is_checkout flag again
        //if all condition ok then go

        if (auth('sanctum')->check() == true) {
            $userId = $request->user()->id;

            $checkCart  = Cart::where('user_id', $userId)
                ->where('status', 'pending')
                ->get();

            if (count($checkCart) < 1) {
                Log::error("data cart_id not found");

                return response()->json([
                    'status' => ['code' => 202, "response" => "Failed", "message" => "data cart_id not found."],
                    'results' => [],
                ]);
            }

            //check is_checkout true
            //generate order_id
            //accumulate data for save to checkouts
            $simpans = [];
            $totalAmount = 0;

            //check total and is_checkout not false
            foreach ($checkCart as $key => $value) {
                $totalAmount += $value['price'];
                if ($value['is_checkout'] == false) {
                    return response()->json([
                        'status' => ['code' => 202, "response" => "Failed", "message" => "cannot checkout now."],
                        'results' => [],
                    ]);
                }

                $simpan[$key]['item_id'] = $value['item_id'];
                $simpan[$key]['quantity'] = $value['quantity'];
                $simpan[$key]['cart_id'] = $value['id'];

                array_push($simpans, $simpan);
            }

            $lastOrder = Checkout::orderByDesc('id')->first();

            if (!$lastOrder)
                $number = 0;
            else
                $number = substr($lastOrder['order_id'], 3);

            $orderId    = "#-" . sprintf('%06d', intval($number) + 1);

            //save data to checkouts
            $saveTocheckout = new Checkout();
            $saveTocheckout->order_id       = $orderId;
            $saveTocheckout->total_amount   = $totalAmount;
            $saveTocheckout->order_status   = "Processing";
            $saveTocheckout->payment_status = "Paid";
            $saveTocheckout->created_at     = strtotime('now');
            $saveTocheckout->updated_at     = strtotime('now');
            $saveTocheckout->cart_detail    = $checkCart;

            $saveTocheckout->save();

            //decrement qty as stock left
            foreach ($simpans as $key => $value) {
                $this->decreaseStock($value[$key]['item_id'], $value[$key]['quantity'], $value[$key]['cart_id']);
            }

            Log::info("success checkout : ". json_encode($saveTocheckout));

            return response()->json([
                'status' => ['code' => 200, "response" => "Success", "message" => "Success checkout order."],
                'results' => $saveTocheckout,
            ]);
        }
    }

    public function decreaseStock($itemId, $qty, $cartId)
    {
        $cartStatus = Cart::where('id', $cartId)->update(['is_checkout' => false, 'status' => 'expired']);

        $decStock = Item::where('id', $itemId)->first();
        $stock = $decStock['quantity'] - $qty;

        $updateStock = Item::find($decStock['id']);
        $updateStock->quantity =  $stock;
        $updateStock->save();
    }
}
