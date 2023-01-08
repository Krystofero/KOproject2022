<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Image;
use App\Models\Offert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Exception;

class ModeratorOffertController extends Controller
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
    public function index() //widok zarządzania ankietami moderatora
    {
        if (!(Auth::user()) || Auth::user()->user_level != "Moderator"){
            return redirect('/');
        }else {
            // $offerts = DB::table('offerts')->get(); //pobiera tylko oferty stworzone przez danego moderatora
            // return view('offert.manage',[
            //     'offerts' => $offerts,   #lista wszystkich ofert zarządzanych przez użytkownika zwracana w blade
            // ]);
            return view('offerts.manage',[
                'offerts' => Offert::all(),   #lista wszystkich ofert zarządzanych przez użytkownika zwracana w blade
            ]);
        }
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = DB::table('users')->get()->where('user_level', 'Klient');
        return view('offerts.create', [
            'clients' => $clients   #lista wszystkich klientów zwracana w blade    
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
        $data = request()->validate([
            'title' => 'required|String|max:150',
            'country' => 'required|String|max:100',
            'description' => 'nullable|String|max:500',
            'startdateturnus' => 'required|date|before_or_equal:enddateturnus|after_or_equal:enddate',
            'enddateturnus' => 'required|date|after_or_equal:startdateturnus|after_or_equal:enddate',
            'price' => 'required|numeric|min:3|gt:0',
            'startdate' => 'required|date|before_or_equal:enddate',
            'enddate' => 'required|date|after_or_equal:startdate',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', //zdjęcie główne
            'nights' => 'required|numeric|gt:0',
            // 'lastminute' => 'nullable|boolean',
            // 'promotion' => 'nullable|boolean',
            'promo' => 'nullable|numeric|min:1|gt:0',
            'promotionprice' => 'nullable|numeric|min:3|gt:0',
            'insuranceprice' => 'nullable|numeric|min:3|gt:0',
            'region' => 'required|String|max:100',
            'city' => 'required|String|max:100',
            // 'allinclusive' => 'nullable|boolean',
            'allindescription' => 'nullable|String|max:500',
            'placedescription' => 'nullable|String|max:500',
            'pricedescription' => 'nullable|String|max:500',
            'persnum' => 'required|numeric|gt:0',
            'hemail' => 'required|String|email|max:255',
            'htel' => 'required|numeric|digits_between:9,15',
            'hoteldescription' => 'nullable|String|max:500',
            'roomsdescription' => 'nullable|String|max:500',
            'disdescription' => 'nullable|String|max:500'
        ]);
        if($request->has('lastminute')){
            //Checkbox checked
            $data['lastminute'] = true;
        }else{
            //Checkbox not checked
            $data['lastminute'] = false;
        }

        if($request->has('promotion')){
            //Checkbox checked
            $data['promotion'] = true;
        }else{
            //Checkbox not checked
            $data['promotion'] = false;
            $data['promo'] = 0;
        }

        if($request->has('allinclusive')){
            //Checkbox checked
            $data['allinclusive'] = true;
        }else{
            //Checkbox not checked
            $data['allinclusive'] = false;
        }

        // dd($request['image']);
        // dd($data['promotion']);
        // dd($data['promotionprice']);
        // dd($data['allinclusive']);
        // dd($data['allindescription']);

        $data['user_id'] = auth()->user()->id; //id użytkownika który utworzył ofertę
        $offert = offert::create($data);

        // dd($request['images']);
        // dd($request['images'][0]);
        // dd($request);

        //Dodawanie zdjęcia głównego
        $image = new Image;
        $path = $request->file('image')->store('/images/resource', ['disk' =>   'my_files']);
        $image->url = $path;
        $image->is_main = true;
        $image->offert_id = $offert->id;
        $image->save();
        //Dodawanie pozostałych zdjęć
        if($request->file('images') != null){
            foreach ($request->file('images') as $imagefile) {
                $image = new Image;
                $path = $imagefile->store('/images/resource', ['disk' =>   'my_files']);
                $image->url = $path;
                $image->is_main = false;
                $image->offert_id = $offert->id;
                $image->save();
            }
        }

        return redirect(route('offertsModerator.show', $offert->id)); //przekierowanie do widoku wyglądu oferty
    }

    /**
     * Show the form with stats of the offert.
     *
     * @param  Offert $offert
     * @return View
     */
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

    /**
     * Show the form with statistics of the specified resource.
     *
     * @param  Offert $offert
     * @return View
     */
    public function stats(Offert $offert)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id)
    { 
        $offert = DB::table('offerts')->get()->where('id', $id)->first(); //znajduje pierwszy element w tabeli o podanym id   
        $images = DB::table('images')->get()->where('offert_id', $id);
        // dd($images->isEmpty());
        return view('offerts.edit', [
                'offert' => $offert,
                'images' => $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOffertRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int  $id)
    {
        $request->validate([
            'title' => 'required|String|max:150',
            'country' => 'required|String|max:100',
            'description' => 'nullable|String|max:500',
            'startdateturnus' => 'required|date|before_or_equal:enddateturnus|after_or_equal:enddate',
            'enddateturnus' => 'required|date|after_or_equal:startdateturnus|after_or_equal:enddate',
            'price' => 'required|numeric|min:3|gt:0',
            'startdate' => 'required|date|before_or_equal:enddate',
            'enddate' => 'required|date|after_or_equal:startdate',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', //zdjęcie główne
            'nights' => 'required|numeric|gt:0',
            // 'lastminute' => 'nullable|boolean',
            // 'promotion' => 'nullable|boolean',
            'promo' => 'nullable|numeric|min:1|gt:0',
            'promotionprice' => 'nullable|numeric|min:3|gt:0',
            'insuranceprice' => 'nullable|numeric|min:3|gt:0',
            'region' => 'required|String|max:100',
            'city' => 'required|String|max:100',
            // 'allinclusive' => 'nullable|boolean',
            'allindescription' => 'nullable|String|max:500',
            'placedescription' => 'nullable|String|max:500',
            'pricedescription' => 'nullable|String|max:500',
            'persnum' => 'required|numeric|gt:0',
            'hemail' => 'required|String|email|max:500',
            'htel' => 'required|numeric|digits_between:9,15',
            'hoteldescription' => 'nullable|String|max:500',
            'roomsdescription' => 'nullable|String|max:500',
            'disdescription' => 'nullable|String|max:500'
        ]);
        if($request->has('lastminute')){
            //Checkbox checked
            $request['lastminute'] = true;
        }else{
            //Checkbox not checked
            $request['lastminute'] = false;
        }

        if($request->has('promotion')){
            //Checkbox checked
            $request['promotion'] = true;
        }else{
            //Checkbox not checked
            $request['promotion'] = false;
            $request['promo'] = 0;
        }

        if($request->has('allinclusive')){
            //Checkbox checked
            $request['allinclusive'] = true;
        }else{
            //Checkbox not checked
            $request['allinclusive'] = false;
        }


        ////Update zdjęcia głównego
        $updatedimage = Image::where([
            'offert_id' => $id,
            'is_main' => true
        ])->get();
        // dd($updatedimage[0]);
        // dd($request['image']);
        if($request['image'] != null){
            $new_main_image_url = $request->file('image')->store('/images/resource', ['disk' =>   'my_files']);
            // dd($new_main_image_url);
            $updatedimage[0]->url = $new_main_image_url;
            $updatedimage[0]->save();
        }

        ////Update zdjęć pobocznych
        if($request->file('images') != null){
            //usunięcie starych zdjęć pobocznych
            DB::table('images')->where([
                'offert_id' => $id,
                'is_main' => false
            ])->delete();
            //dodanie nowych zdjęć pobocznych
            foreach ($request->file('images') as $imagefile) {
                $image = new Image;
                $path = $imagefile->store('/images/resource', ['disk' =>   'my_files']);
                $image->url = $path;
                $image->is_main = false;
                $image->offert_id = $id;
                $image->save();
            }
        }
        $new_title = $request->all()['title'];
        $new_country = $request->all()['country'];
        $new_description = $request->all()['description'];
        $new_startdateturnus = $request->all()['startdateturnus'];
        $new_enddateturnus = $request->all()['enddateturnus'];
        $new_price = $request->all()['price'];
        $new_startdate = $request->all()['startdate'];
        $new_enddate = $request->all()['enddate'];
        $new_nights = $request->all()['nights'];
        $new_promo = $request->all()['promo'];
        $new_promotionprice = $request->all()['promotionprice'];
        $new_insuranceprice = $request->all()['insuranceprice'];
        $new_region = $request->all()['region'];
        $new_city = $request->all()['city'];
        $new_allindescription = $request->all()['allindescription'];
        $new_placedescription = $request->all()['placedescription'];
        $new_pricedescription = $request->all()['pricedescription'];
        $new_persnum = $request->all()['persnum'];
        $new_hemail = $request->all()['hemail'];
        $new_htel = $request->all()['htel'];
        $new_hoteldescription = $request->all()['hoteldescription'];
        $new_roomsdescription = $request->all()['roomsdescription'];
        $new_disdescription = $request->all()['disdescription'];

        $updatedoffert = Offert::find($id);

        $updatedoffert->title = $new_title;
        $updatedoffert->country = $new_country;
        $updatedoffert->description = $new_description;
        $updatedoffert->startdateturnus = $new_startdateturnus;
        $updatedoffert->enddateturnus = $new_enddateturnus;
        $updatedoffert->price = $new_price;
        $updatedoffert->startdate = $new_startdate;
        $updatedoffert->enddate = $new_enddate;
        $updatedoffert->nights = $new_nights;
        $updatedoffert->promo = $new_promo;
        $updatedoffert->promotionprice = $new_promotionprice;
        $updatedoffert->insuranceprice = $new_insuranceprice;
        $updatedoffert->region = $new_region;
        $updatedoffert->city = $new_city;
        $updatedoffert->allindescription = $new_allindescription;
        $updatedoffert->placedescription = $new_placedescription;
        $updatedoffert->pricedescription = $new_pricedescription;
        $updatedoffert->persnum = $new_persnum;
        $updatedoffert->hemail = $new_hemail;
        $updatedoffert->htel = $new_htel;
        $updatedoffert->hoteldescription = $new_hoteldescription;
        $updatedoffert->roomsdescription = $new_roomsdescription;
        $updatedoffert->disdescription = $new_disdescription;

        $updatedoffert->save();

        // return redirect(route('offertsModerator.index'))->with('status', __('offerts.update.success'));
        return redirect()->back()->with('status', ('Oferta została zaktualizowana pomyślnie'));
    }

  /**
     * Remove the specified resource from storage.
     *
     * @param Offert $offert
     * @return JsonResponse
     */
    public function destroy(Offert $offert)
    {   
        // dd($offert);
        try {
            $offert->delete();
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }

}