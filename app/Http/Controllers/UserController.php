<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Traits\AccountTrait;

class UserController extends Controller
{
    use AccountTrait;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try 
        {
            if (! $token = JWTAuth::attempt($credentials)) 
                return response()->json(['error' => 'Unauthorized'], 401);
        } 
        catch (JWTException $e) {return response()->json(['error' => 'could_not_create_token'], 500);}
        
        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails())
           return response()->json($validator->errors()->toJson(), 400);
        

        $user_id = time();

        $user = User::create([
            'user_id' => $user_id,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        Account::create([
          'user_id' => $user_id,
          'account_type' => $this->getDefaultAccountType(),
          'account_number' => $this->generateAccountNumber()
        ]);

        if(is_null($user))
          return response()->json(['status' => false, 'message' => 'Error occured!' ]);

        return response()->json(['status' => true, 'message' => 'User created successfully' ]);
    }

    public function getAuthenticatedUser()
        {
                try {

                        if (! $user = JWTAuth::parseToken()->authenticate()) {
                                return response()->json(['user_not_found'], 404);
                        }

                } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                        return response()->json(['token_expired'], $e->getStatusCode());

                } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                        return response()->json(['token_invalid'], $e->getStatusCode());

                } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                        return response()->json(['token_absent'], $e->getStatusCode());

                }

                return response()->json(compact('user'));
        }

        public function getDefaultAccountType()
        {
            $account_type = AccountType::where(['is_default' => true])->first();
            return $account_type->id;
        }
}