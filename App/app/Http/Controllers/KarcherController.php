<?php

namespace App\Http\Controllers;

use App\Models\Karcher;
use Illuminate\Http\Request;

class KarcherController extends Controller
{
    public function index()
    {
//        $karcher = Karcher::query()->orderBy('id', 'DESC')->paginate(4);
        $karcher=Karcher::all();
        return view('karcher.list', ['karcher' => $karcher]);
    }

    public function create()
    {
        return view('karcher.create');
    }


    public function store(Request $request)
    {
        $karcher =Karcher::query()->create($request->post());
        if ($karcher) {
            $karcher->save();
            return redirect()->route('karcher.index')->with('success','Karcher Added Successfully');
        }else{
            return redirect()->route('karcher.create')->withErrors(error_get_last())->withInput();
        }
    }



    public function edit(Karcher $karcher)
    {
        return view('karcher.edit',['karcher'=>$karcher]);
    }


    public function update(Request $request, Karcher $karcher)
    {
        $data=$request->validate([
             "name"=>["required","string"],
             "longitude"=>["required"],
             "latitude"=>["required"],
             "address"=>["required"],
             "director"=>["required","string"],
             "phone"=>["required"],
             "countPersons"=>["required"],
        ]);
        if ($data) $karcher->fill(request()->post());
        if ($karcher){
            $karcher->save();
            return redirect()->route('karcher.index')->with('success', 'Karcher successfully updated');
        }else{
            return redirect()->route('karcher.edit',$karcher->id)->withErrors(error_get_last())->withInput();
        }
    }


    public function destroy($id)
    {
      $karcher = Karcher::query()->find($id);
      if($karcher){
          $karcher->delete();
          return redirect()->route('karcher.index')->with('success','Karcher successfully deleted');
      }
      return redirect()->route('karcher.index')->with('error','Karcher not found');
    }
}
