<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * time token is valid in minutes
     * currently - 180 days
     * 
     * @var int
     */
    public $token_valid_for = 259200;

    /**
     * days the access token is valid
     * 
     * @var int
     */
    private $days_token_valid = 180;

    private $token_name = "stago_token";

    // updates made to laravel sanctum guard vendor file 
    // vendor/laravel/sanctum/src/Guard.php lines 93, 94, 95 - see below
    // 
    // // extend token expire time when user is authenticating...
    // $accessToken->expires_at = Carbon::now()->addMinutes((new AuthController)->token_valid_for);
    // $accessToken->save();


    /**
     * Creates a users session information
     *
     * @param User $user
     * @return object{}
     */
    public static function get_session(User $user){
        return (object) [
            "id"=> $user->id,
            "name"=> $user->name,
            "email"=> $user->email,
            "role"=> $user->role
        ];
    }

    /**
     * Log a user in and return plain text token for authentication
     *
     * @param Request $request
     * @return object{message: string, token: string}
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            "email"=> "required|email",
            "password"=> "required|min:8"
        ]);

        if($validator->fails()){
            return response()->json(["errors"=> $validator->errors()], 400);
        }

        // check if the user exists
        if(!User::where('email', strtolower($request->email))->exists()){
            return response()->json(["message"=> "the requested user does not exist."], 404);
        }

        if(Auth::attempt(['email'=> strtolower($request->email), 'password'=> $request->password])){
            $user = Auth::user();
            // Create auth token
            $token = $user->createToken($this->token_name, [$user->role], Carbon::now()->addDays($this->days_token_valid));
            // save the ip of the requesting user
            // DB::table('personal_access_tokens')->where('id', $token->accessToken->id)->update(['ip'=> $request->ip()]);
            
            $response = [
                // pass plain text token
                'token'=> $token->plainTextToken,
                'message'=> 'user login successful.'
            ];

            return response()->json($response, 200);
        } else {
            return response()->json(['message'=> 'incorrect password entered.'], 401);
        }
    }

    /**
     * Logout a user session or all sessions
     *
     * @param Request $request
     * @param string $all single or all user sessions to logout
     * @return object{message: string}
     */
    public function logout(Request $request, string $all = ""){
        switch($all){
            case 'all': 
                $request->user()->tokens()->delete();
                break;
            default:
                $request->user()->currentAccessToken()->delete();
                break;
        }

        return response()->json(["message"=> "user logged out successfully."], 200);
    }

    /**
     * Get a users session information
     *
     * @param Request $request
     * @return object{session: object}
     */
    public function session(Request $request){
        return response()->json(["session"=> self::get_session($request->user())], 200);
    }
}
