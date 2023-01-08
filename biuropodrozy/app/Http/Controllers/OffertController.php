<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Offert;
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
            ->join('images', function ($join) {
                $join->on('images.offert_id', '=', 'offerts.id')
                    ->where('images.is_main', '=', true);
            })
            ->paginate(10);
            // ->get();
            // dd($offerts);

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
            // dd($promotion);

            return view('offerts.list',[ 
                // 'offerts' =>  Offert::all(), #lista wszystkich ofert
                'offerts' =>  $offerts, #lista wszystkich ofert
                'cities' => $cities,
                'countries' => $countries,
                'regions' => $regions,
                'promotion' => $promotion,
                'lastminute' => $lastminute
            ]);
            
    }

    public function show(int $id)
    {
        // //// Lazy Eager Loading - ładowanie dynamiczne "z opóźnieniem"
        // $offert->load('offert.photos');

        // return view('offert.show', compact('offert'));

        $offert = DB::table('offerts')->get()->where('id', $id)->first(); //znajduje pierwszy element w tabeli o podanym id
        $images = DB::table('images')->get()->where('offert_id', $id);
        return view('offerts.show', [
            'offert' => $offert,
            'images' => $images
        ]);
    }

}
