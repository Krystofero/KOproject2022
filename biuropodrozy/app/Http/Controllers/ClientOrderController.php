<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Offert;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Exception;

class ClientOrderController extends Controller
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
    public function index() //widok zarządzania zamówieniami Klienta
    {
        if (!(Auth::user()) || Auth::user()->user_level != "Klient"){
            return redirect('/');
        }else {
            $orders = DB::table('orders')->get()->where('user_id', Auth::user()->id);
            return view('orders.list', [
                'orders' => $orders
            ]);
        }
            
    }

}