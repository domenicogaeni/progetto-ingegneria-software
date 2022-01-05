<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    public static function getValidationRules()
    {
        return [
            'new' => [
                'book_id' => 'required|exists:books,id',
                'address' => 'required|string|max:255',
            ],
        ];
    }

    public function new(Request $request)
    {
        $params = $request->only(['book_id', 'address']);
        $user = Auth::user();

        $address = Address::where('user_id', $user->id)
            ->where('address', $params['address'])
            ->first();
        if (!$address) {
            $address = Address::create([
                'address' => $params['address'],
                'user_id' => $user->id,
            ]);
        }

        $order = new Order();
        $order->status = Order::STATUS_PENDING;
        $order->user_id = $user->id;
        $order->address_id = $address->id;
        $order->book_id = $params['book_id'];
        $order->save();

        $order->refresh();

        return $order;
    }
}
