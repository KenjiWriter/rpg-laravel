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
            'strength' => 'required|numeric',
            'intelligence' => 'required|numeric',
            'endurance' => 'required|numeric',
            'luck' => 'required|numeric',
            'buyPrice' => 'required|numeric',
        ]);

        //Inser into Database
        $item = new Item;
        $item->name = $request->name;
        $item->icon = $request->name.'.jpg';
        $item->type = $request->type;
        $item->rare = $request->rare;
        $item->req_lvl = $request->required_lvl;
        $item->strength = $request->strength;
        $item->intelligence = $request->intelligence;
        $item->endurance = $request->endurance;
        $item->luck = $request->luck;
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
