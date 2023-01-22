<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Offert;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;

class ModeratorOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //widok zarządzania zamówieniami moderatora
    {
        if (!(Auth::user()) || Auth::user()->user_level != "Moderator"){
            return redirect('/');
        }else {
            return view('offerts.stats', [
                // 'offerts' => Offert::all(),
                'orders' => Order::all(),
                'order_status_list' => array(1 => 'Oczekujące', 2 => 'Zaakceptowane', 3 => 'Zrealizowane')
            ]);
        }
            
    }

    public function updateOrderStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => 'Zmieniono status zamówienia']);
    }

}