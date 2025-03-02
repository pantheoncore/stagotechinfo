<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\system_applications;
use App\Models\systems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SystemApplications extends Controller
{
    public function create(Request $request, string $system_id) {
        $data = $request->all();
        $validator = Validator::make($data, [
            "name"=> "required|min:5",
            "version"=> "required"
        ]);

        if($validator->fails()){
            return response()->json(["errors"=> $validator->errors()], 400);
        }

        if(!systems::find($system_id)){
            return response()->json(["message"=> "the requested system was not found"], 404);
        }

        $data["system_id"] = $system_id;
        system_applications::create($data);

        return response()->json(["message"=> "system application created sucessfully"]);
    }
}
