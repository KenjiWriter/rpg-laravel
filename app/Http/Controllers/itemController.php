<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;

use Auth;
use Illuminate\Support\Facades\Session;

class itemController extends Controller
{
    function add()
    {
        if(auth()->user()->admin_power <= 9) {
            return back();
        }
        return view('admin.additem');
    }

    function save(Request $request)
    {
        //Validate data
        $request->validate([
            'name' => 'required|unique:items',
            'required_lvl' => 'required|numeric',
            'icon' => 'required',
            'strength_min' => 'required|numeric',
            'intelligence_min' => 'required|numeric',
            'vitality_min' => 'required|numeric',
            'endurance_min' => 'required|numeric',
            'dexterity_min' => 'required|numeric',
            'buyPrice' => 'required|numeric',
        ]);

        $strengthArr = ['min' => $request->strength_min, 'max' => $request->strength_max];
        $intelligenceArr = ['min' => $request->intelligence_min, 'max' => $request->intelligence_max];
        $enduranceArr = ['min' => $request->endurance_min, 'max' => $request->endurance_max];
        $vitalityArr = ['min' => $request->vitality_min, 'max' => $request->vitality_max];
        $dexterityArr = ['min' => $request->dexterity_min, 'max' => $request->dexterity_max];

        //Inser into Database
        $item = new Item;
        $item->name = $request->name;
        $item->icon = $request->name.'.jpg';
        $item->type = $request->type;
        $item->rare = $request->rare;
        $item->req_lvl = $request->required_lvl;
        $item->strength = json_encode($strengthArr);
        $item->intelligence = json_encode($intelligenceArr);
        $item->endurance = json_encode($enduranceArr);
        $item->vitality = json_encode($vitalityArr);
        $item->dexterity = json_encode($dexterityArr);
        $item->buyPrice = $request->buyPrice;
        $save = $item->save();

        //Save
        if($save) {
            //upload icon
            if(isset($request->icon)) {
                $imageName = $request->name.'.jpg';
                $request->icon->move(public_path('/items'), $imageName);
            }
            return back()->with('success', 'New item was added to database');
        } else {
            return back()->with('fail', 'Something went wrong try again later');
        }
    }
}
