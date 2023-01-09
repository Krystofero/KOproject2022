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
                'orders' => Order::all()
            ]);
        }
            
    }

}