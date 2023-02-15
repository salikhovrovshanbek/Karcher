<?php

namespace App\Services;

use App\Models\Karcher;

class KarcherCreateService
{

    public function StoreKarcher($data)
    {

        $data=Karcher::query()->create([
            'name'=>$data["name"],
            'longitude'=>$data["longitude"],
            'latitude'=>$data['latitude'],
            'address'=>$data['address'],
            'director'=>$data['director'],
            'phone'=>$data['phone'] ?? '',
            'countPersons'=>$data['countPersons'],
        ]);
        return $data;
    }

}
