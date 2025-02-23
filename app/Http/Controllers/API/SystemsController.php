<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    /**
     * get a systems overview
     *
     * @param Request $request
     * @param string $id system ID
     * 
     * @return object{system: systems, message: string}
     */
    public function overview(Request $request, string $id){
        $system = systems::find($id);
        if(!$system){
            return response()->json(["message"=> "the requested system was not found"], 404);
        }

        return response()->json(["system"=> $system]);
    }

    /**
     * update an existing system
     *
     * @param Request $request
     * @param string $id system id
     * 
     * @return object{message: string}
     */
    public function update(Request $request, string $id){
        $data = $request->all();
        $validator = Validator::make($data, [
            "name"=> "required|min:5",
            "desc"=> "required|max:225",
            "image_url"=> "required"
        ]);

        if($validator->fails()){
            return response()->json(["errors"=> $validator->errors()], 400);
        }

        $system = systems::find($id);
        $system->fill($data);

        $system->save();

        return response()->json(["message"=> "system updated successfully"]);
    }
}
