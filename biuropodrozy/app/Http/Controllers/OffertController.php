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
    public function index(Request $request) //widok z publicznymi ofertami
    {       
        // $validatedData = $request->validate([
        //     'search' => 'string|max:255',
        //     'region' => 'string|in:north,south,east,west',
        //     'country' => 'string|in:usa,canada,mexico',
        //     // Add more validation rules for the other filters
        // ]);


            $today = Carbon::now();

            // $offerts = Offert::where('startdate', '<=', $today)
            // ->where('enddate', '>=', $today)
            // ->where('amount', '>', 0)
            // ->join('images', function ($join) {
            //     $join->on('images.offert_id', '=', 'offerts.id')
            //         ->where('images.is_main', '=', true);
            // })
            // ->paginate(10);

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

            $lato = null;
            $latostart = null;
            $latoend = null;
            $ccountry = null;
            $ccity = null;
            $rregion = null;
            $ppersnum = null;
            $pprice = null;
            $ppromo = null;

            if ($request->ajax()) {

                $offerts = Offert::query();
                //Requesty z filrowania i wyszukiwarki
                if ($request->has('search') && !empty($request->input('search'))) {
                    // $offerts->where('country', 'like', '%' . $request->input('search') . '%')
                    // ->orWhere('city', 'like', '%' . $request->input('search') . '%')
                    // ->orWhere('region', 'like', '%' . $request->input('search') . '%')
                    // ->orWhere('title', 'like', '%' . $request->input('search') . '%'); 
                    $req = $request->input('search');
                    $offerts->where(function ($query) use ($req) {
                        $query->where('country', 'like', '%' . $req . '%')
                            ->orWhere('city', 'like', '%' . $req . '%')
                            ->orWhere('region', 'like', '%' . $req . '%')
                            ->orWhere('title', 'like', '%' . $req . '%');
                    }); 
                }

                if ($request->has('country') && !empty($request->input('country'))) {
                    $offerts->where('country', $request->input('country'));
                    $ccountry = $request->input('country');
                }

                if ($request->has('region') && !empty($request->input('region'))) {
                    $offerts->where('region', $request->input('region'));
                    $rregion = $request->input('region');
                }

                if ($request->has('city') && !empty($request->input('city'))) {
                    $offerts->where('city', $request->input('city'));
                    $ccity = $request->input('city');
                }

                if ($request->has('price') && !empty($request->input('price'))) {
                    $req = $request->input('price');
                    $offerts->where(function ($query) use ($req) {
                        $query->whereBetween('price', [$req, 10000])
                            ->whereNull('promotionprice')
                            ->orwhereBetween('promotionprice', [$req, 10000]);
                    }); 
                    $pprice = $request->input('price');
                }

                if ($request->has('persnum') && !empty($request->input('persnum'))) {
                    $offerts->whereBetween('persnum', [$request->input('persnum'), 10]);
                    $ppersnum = $request->input('persnum');
                }

                if ($request->has('startdate') && !empty($request->input('startdate'))) {
                    $offerts->where('startdateturnus', '>=', $request->input('startdate'));
                    $latostart = $request->input('startdate');
                }

                if ($request->has('enddate') && !empty($request->input('enddate'))) {
                    $offerts->where('enddateturnus', '<=', $request->input('enddate'));
                    $latoend = $request->input('enddate');
                }

                if ($request->has('promotion') && !empty($request->input('promotion'))) {
                    $offerts->where('promotion', true);
                    $promotion = $request->input('promotion');
                }
                if ($request->has('allinclusive') && !empty($request->input('allinclusive'))) {
                    $offerts->where('allinclusive', true);
                    $allinclusive = $request->input('allinclusive');
                }
                if ($request->has('lastminute') && !empty($request->input('lastminute'))) {
                    $offerts->where('lastminute', true);
                    $lastminute = $request->input('lastminute');
                }
                if ($request->has('promo') && !empty($request->input('promo'))) {
                    $offerts->whereBetween('promo', [$request->input('promo'), 100]);
                    $ppromo = $request->input('promo');
                }

                //Sortowanie
                if ($request->has('sort') && $request->has('order')) {
                    $offerts->orderBy($request->input('sort'), $request->input('order'));
                }

                $offerts = $offerts->where('startdate', '<=', $today)
                ->where('enddate', '>=', $today)
                ->where('amount', '>', 0)
                ->join('images', function ($join) {
                    $join->on('images.offert_id', '=', 'offerts.id')
                        ->where('images.is_main', '=', true);
                })
                ->paginate(10);

                //Dodanie odpowiednich przekierowań do paginacji
                if ($request->has('search') && !empty($request->input('search'))) {
                    $offerts->appends(array('search' => $request->input('search')))->links();
                }

                if ($request->has('country') && !empty($request->input('country'))) {
                    $offerts->appends(array('ccountry' => $request->input('country')))->links();
                }

                if ($request->has('region') && !empty($request->input('region'))) {
                    $offerts->appends(array('rregion' => $request->input('region')))->links();
                }

                if ($request->has('city') && !empty($request->input('city'))) {
                    $offerts->appends(array('ccity' => $request->input('city')))->links();
                }

                if ($request->has('price') && !empty($request->input('price'))) {
                    $offerts->appends(array('price' => $request->input('price')))->links();
                }

                if ($request->has('persnum') && !empty($request->input('persnum'))) {
                    $offerts->appends(array('persnum' => $request->input('persnum')))->links();
                }

                if ($request->has('startdate') && !empty($request->input('startdate'))) {
                    $offerts->appends(array('startdate' => $request->input('startdate')))->links();
                }

                if ($request->has('enddate') && !empty($request->input('enddate'))) {
                    $offerts->appends(array('enddate' => $request->input('enddate')))->links();
                }

                if ($request->has('promotion') && !empty($request->input('promotion'))) {
                    $offerts->appends(array('promotion' => 1))->links();
                }
                if ($request->has('allinclusive') && !empty($request->input('allinclusive'))) {
                    $offerts->appends(array('allinclusive' => 1))->links();
                }
                if ($request->has('lastminute') && !empty($request->input('lastminute'))) {
                    $offerts->appends(array('lastminute' => 1))->links();
                }
                if ($request->has('promo') && !empty($request->input('promo'))) {
                    $offerts->appends(array('promo' => $request->input('promo')))->links();
                }
                //Sortowanie
                if ($request->has('sort') && $request->has('order')) {
                    $offerts->appends(array('sort' => $request->input('sort')))->links();
                    $offerts->appends(array('order' => $request->input('order')))->links();
                }
            
                return view('offerts.list',[ 
                    'offerts' =>  $offerts, #lista wszystkich ofert
                    'cities' => $cities,
                    'countries' => $countries,
                    'regions' => $regions,
                    // 'promotion' => $promotion,
                    // 'lastminute' => $lastminute,
                    'lato' => $lato,
                    'latostart' => $latostart,
                    'latoend' => $latoend,
                    'ccountry' => $ccountry,
                    'ccity' => $ccity,
                    'rregion' => $rregion,
                    'ppersnum' => $ppersnum,
                    'pprice' => $pprice,
                    'ppromo' => $ppromo
                ])->render();
            } else {
                //Requesty z paska szybkiego dostępu i z linków przy ofertach
                $promotion = request()->promotion;
                $lastminute = request()->lastminute;
                $allinclusive = request()->allinclusive;
                $lato = request()->lato;
                $ccountry = request()->ccountry;
                $ccity = request()->ccity;
                $rregion = request()->rregion;


                $offerts = Offert::query();

                if($promotion == 1){
                    $offerts->where('promotion', true);
                }
                if($lastminute == 1){
                    $offerts->where('lastminute', true);
                }
                if($allinclusive == 1){
                    $offerts->where('allinclusive', true);
                }
                if($ccountry != null){
                    $offerts->where('country', $ccountry);
                }
                if($ccity != null){
                    $offerts->where('city', $ccity);
                }
                if($rregion != null){
                    $offerts->where('region', $rregion);
                }

                if($lato == 1){
                    $latostart = '2023-06-01';
                    $latoend = '2023-10-01';
                    $offerts->where('startdateturnus', '>=', $latostart);
                    $offerts->where('enddateturnus', '<=', $latoend);
                }
                else{
                    $offerts->where('startdate', '<=', $today);
                    $offerts->where('enddate', '>=', $today);
                }

                //Przekierowania do paginacji przy ajax
                if ($request->has('price') && !empty($request->input('price'))) {
                    $req = $request->input('price');
                    $offerts->where(function ($query) use ($req) {
                        $query->whereBetween('price', [$req, 10000])
                            ->whereNull('promotionprice')
                            ->orwhereBetween('promotionprice', [$req, 10000]);
                    }); 
                    $pprice = $request->input('price');
                }

                if ($request->has('persnum') && !empty($request->input('persnum'))) {
                    $offerts->whereBetween('persnum', [$request->input('persnum'), 10]);
                    $ppersnum = $request->input('persnum');
                }

                if ($request->has('startdate') && !empty($request->input('startdate'))) {
                    $offerts->where('startdateturnus', '>=', $request->input('startdate'));
                    $latostart = $request->input('startdate');
                }

                if ($request->has('enddate') && !empty($request->input('enddate'))) {
                    $offerts->where('enddateturnus', '<=', $request->input('enddate'));
                    $latoend = $request->input('enddate');
                }

                if ($request->has('promo') && !empty($request->input('promo'))) {
                    $offerts->whereBetween('promo', [$request->input('promo'), 100]);
                    $ppromo = $request->input('promo');
                }
                
                //Sortowanie
                if ($request->has('sort') && $request->has('order')) {
                    $offerts->orderBy($request->input('sort'), $request->input('order'));
                }


                $offerts = $offerts->where('amount', '>', 0)
                ->join('images', function ($join) {
                    $join->on('images.offert_id', '=', 'offerts.id')
                        ->where('images.is_main', '=', true);
                })
                ->paginate(10);

                //Dodanie odpowiednich przekierowań do paginacji
                if($lato == 1){
                    $offerts->appends(array('lato' => '1'))->links();
                }
                if($promotion == 1){
                    $offerts->appends(array('promotion' => '1'))->links();
                }
                if($lastminute == 1){
                    $offerts->appends(array('lastminute' => '1'))->links();
                }
                if($allinclusive == 1){
                    $offerts->appends(array('allinclusive' => '1'))->links();
                }
                if($ccountry != null){
                    $offerts->appends(array('ccountry' => $ccountry))->links();
                }
                if($ccity != null){
                    $offerts->appends(array('ccity' => $ccity))->links();
                }
                if($rregion != null){
                    $offerts->appends(array('rregion' => $rregion))->links();
                }
                //Sortowanie
                if ($request->has('sort') && $request->has('order')) {
                    $offerts->appends(array('sort' => $request->input('sort')))->links();
                    $offerts->appends(array('order' => $request->input('order')))->links();
                }

                return view('offerts.list',[ 
                    // 'offerts' =>  Offert::all(), #lista wszystkich ofert
                    'offerts' =>  $offerts, #lista wszystkich ofert
                    'cities' => $cities,
                    'countries' => $countries,
                    'regions' => $regions,
                    'lato' => $lato,
                    'latostart' => $latostart,
                    'latoend' => $latoend,
                    'ccountry' => $ccountry,
                    'ccity' => $ccity,
                    'rregion' => $rregion,
                    'ppersnum' => $ppersnum,
                    'pprice' => $pprice,
                    'ppromo' => $ppromo
                ]);
            }


            // return view('offerts.list',[ 
            //     // 'offerts' =>  Offert::all(), #lista wszystkich ofert
            //     'offerts' =>  $offerts, #lista wszystkich ofert
            //     'cities' => $cities,
            //     'countries' => $countries,
            //     'regions' => $regions,
            //     'promotion' => $promotion,
            //     'lastminute' => $lastminute,
            //     'lato' => $lato,
            //     'latostart' => $latostart,
            //     'latoend' => $latoend,
            //     'ccountry' => $ccountry,
            //     'ccity' => $ccity,
            //     'rregion' => $rregion
            // ]);
            
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
