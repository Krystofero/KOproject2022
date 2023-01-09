<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Offert;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class OffertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index() //widok z publicznymi ofertami
    {       
            $today = Carbon::now();

            // $offerts = DB::table('offerts')
            // ->join('images', function ($join) {
            //     $join->on('images.offert_id', '=', 'offerts.id')
            //         ->where('images.is_main', '=', true);
            // })
            // ->where('startdate', '<=', $today)
            // ->where('enddate', '>=', $today)
            // ->get();

            $offerts = Offert::where('startdate', '<=', $today)
            ->where('enddate', '>=', $today)
            ->where('amount', '>', 0)
            ->join('images', function ($join) {
                $join->on('images.offert_id', '=', 'offerts.id')
                    ->where('images.is_main', '=', true);
            })
            ->paginate(10);
            // ->simplePaginate(10);
            // ->get();
            // dd($offerts);
            // dd($offerts->links());

            $cities = DB::table('offerts')
                ->select('city')
                ->distinct()
                ->get();
            // dd($cities);
            $countries = DB::table('offerts')
            ->select('country')
            ->distinct()
            ->get();

            $regions = DB::table('offerts')
            ->select('region')
            ->distinct()
            ->get();

            $promotion = request()->promotion;
            $lastminute = request()->lastminute;
            $allinclusive = request()->allinclusive;
            $lato = request()->lato;
            $ccountry = request()->ccountry;
            $ccity = request()->ccity;
            $rregion = request()->rregion;

            $latostart = null;
            $latoend = null;

            if($lato == 1){
                $latostart = '2023-06-01';
                $latoend = '2023-10-01';
            }
            // dd($latostart);

            return view('offerts.list',[ 
                // 'offerts' =>  Offert::all(), #lista wszystkich ofert
                'offerts' =>  $offerts, #lista wszystkich ofert
                'cities' => $cities,
                'countries' => $countries,
                'regions' => $regions,
                'promotion' => $promotion,
                'lastminute' => $lastminute,
                'lato' => $lato,
                'latostart' => $latostart,
                'latoend' => $latoend,
                'ccountry' => $ccountry,
                'ccity' => $ccity,
                'rregion' => $rregion
            ]);
            
    }

    public function show(int $id)
    {   
        // //// Lazy Eager Loading - ładowanie dynamiczne "z opóźnieniem"
        // $offert->load('offert.photos');

        // return view('offert.show', compact('offert'));

        $offert = DB::table('offerts')->get()->where('id', $id)->first(); //znajduje pierwszy element w tabeli o podanym id
        $images = DB::table('images')->get()->where('offert_id', $id);
        return view('offerts.showclient', [
            'offert' => $offert,
            'images' => $images
        ]);
    }

    public function buy(int $id)
    {
        $offert = DB::table('offerts')->get()->where('id', $id)->first();
        
        if($offert->promotion == true && $offert->promotionprice != null){
            $sumprice = $offert->promotionprice * $offert->persnum;
        }
        else{
            $sumprice = $offert->price * $offert->persnum;
        }

        if($offert->insuranceprice != null){
            $inssumprice = $offert->insuranceprice * $offert->persnum;
        }
        else{
            $inssumprice = null;
        }
        
        return view('offerts.buy', [
            'offert' => $offert,
            'sumprice' => $sumprice,
            'inssumprice' => $inssumprice
        ]);

    }

    /**
     * Store in storage and save a newly created offert.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->validate([
            'user_id' => 'required',
            'offert_id' => 'required',
            'firstname' => 'required|String|max:255',
            'lastname' => 'required|String|max:255',
            'email' => 'required|String|max:255',
            'tel' => 'required|numeric|digits_between:9,15',
            'price' => 'required|numeric|min:3|gt:0'
        ]);
        // if($request->has('basic')){
        //     //Checkbox checked
        //     $data['basic'] = true;
        // }else{
        //     //Checkbox not checked
        //     $data['basic'] = false;
        // }
        if($request->has('insurance')){
            //Checkbox checked
            $data['insurance'] = true;
        }else{
            //Checkbox not checked
            $data['insurance'] = false;
        }
        // $data['user_id'] = auth()->user()->id; //id użytkownika który utworzył ofertę
        $order = Order::create($data);

        $offert = Offert::where('id', '=', $data['offert_id'])->first();
        $offert->amount -= 1;
        $offert->save();

        return redirect()->route('offerts.index')->with('success', 'Offert bought successfully!'); //przekierowanie do widoku ofert
        // return view('offerts.index', [
        //     'offert' => $offert,
        //     'sumprice' => $sumprice,
        //     'inssumprice' => $inssumprice
        // ]);
    }

}
