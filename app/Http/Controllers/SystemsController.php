<?php

namespace App\Http\Controllers;

use App\Models\systems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SystemsController extends Controller
{
    /**
     * get all systems
     *
     * @param Request $request
     * @return object{systems: array}
     */
    public function get(Request $request){
        return response()->json(["systems"=> systems::all()]);
    }

    /**
     * create a new system
     *
     * @param Request $request
     * @return object{message: string}
     */
    public function create(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            "name"=> "required|min:5",
            "desc"=> "required|max:225",
            "image_url"=> "required"
        ]);

        if($validator->fails()){
            return response()->json(["errors"=> $validator->errors()], 400);
        }

        $system = new systems();
        $system->fill($data);

        $system->save();

        return response()->json(["message"=> "system created successfully"]);
    }
}
