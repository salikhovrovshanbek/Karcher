<?php

namespace App\Http\Controllers;

use App\Models\Karcher;
use App\Http\Requests\KarcherDeleteRequest;
use App\Http\Requests\KarcherRequest;
use App\Services\KarcherCreateService;

class KarcherController extends Controller
{
    public function index()
    {
////        $karcher = Karcher::query()->orderBy('id', 'DESC')->paginate(4);
//        $karcher=Karcher::query()->get();
////        dd($karcher);
//        return response()->json(['karcher' => $karcher]);//->with('karcher' , $karcher);
        return Karcher::query()->select()->get();
    }

//    public function create()
//    {
//        return view('karcher.create');
//    }


    public function store(KarcherRequest $request, KarcherCreateService $service)
    {
        $data=$request->validated();
        if ($data){
            $karcher=$service->StoreKarcher($data);
            $karcher->save();
            return ['success','Karcher Added Successfully'];
        } else{
            return error_get_last();
        }
    }



//    public function edit(Karcher $karcher)
//    {
//        return view('karcher.edit',['karcher'=>$karcher]);
//    }

    public function show(Karcher $karcher)
    {
        return response()->json([
            'karcher'=>$karcher
        ]);
    }


    public function update(KarcherRequest $request, Karcher $karcher)
    {
        $data=$request->validated();
        if ($data) $karcher->fill(request()->post());
        if ($karcher){
            $karcher->save();
            return ['success', 'Karcher successfully updated'];
        }else{
            return error_get_last();
        }
    }


    public function destroy(KarcherDeleteRequest $request)
    {
      $id=$request['id'];
      $karcher = Karcher::query()->find($id);
      if($karcher){
          $karcher->delete();
          return ['success','Karcher successfully deleted'];
      }
      return ['error','Karcher not found'];
    }
}
