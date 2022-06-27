<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\AccountTrait;

class AccountController extends Controller
{
    use AccountTrait;
   
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_type' => 'required'
        ]);

        if($validator->fails())
           return response()->json($validator->errors()->toJson(), 400);

        if($this->checkIfAccountsLimitIsExceeded())
            return response()->json(['status' => false, 'message' => 'Sorry! Account not created. Number of accounts exceeded' ]);

        $account = Account::create([
            'user_id' => auth()->user()->user_id,
            'account_type' => $request->account_type,
            'account_number' => $this->generateAccountNumber()
        ]);

        if(is_null($account))
            return response()->json(['status' => false, 'message' => 'Error occured!' ]);

        return response()->json(['status' => true, 'message' => 'Account created successfully' ]);
    }

    public function fund(Request $request, $account_number)
    {
        
        $account = Account::where('account_number', $account_number)->first(); 

        $validator = Validator::make($request->all(), [
            'deposit_amount' => 'required'
        ]);

        if($validator->fails())
           return response()->json($validator->errors()->toJson(), 400);

        if(is_null($account))
           return response()->json(['status' => false, 'message' => 'Account does not exist!' ]);
        
        $account->amount += $request->deposit_amount;
        $account->save(); 

        return response()->json(['status' => true, 'message' => 'Account funded successfully' ]);       
    }

    public function withdraw(Request $request, $account_number)
    {
        $validator = Validator::make($request->all(), [
            'withdraw_amount' => 'required'
        ]);

        if($validator->fails())
           return response()->json($validator->errors()->toJson(), 400);

        $account = Account::where('account_number', $account_number)->first(); 

        if(is_null($account))
           return response()->json(['status' => false, 'message' => 'Account does not exist!' ]);

        if($account->amount < $request->withdraw_amount)
            return response()->json(['status' => false, 'message' => 'Insufficient funds' ]);

        $account->amount -= $request->withdraw_amount;

        $account->save(); 
          
        if(is_null($account))
            return response()->json(['status' => false, 'message' => 'Error occured!' ]);

        return response()->json(['status' => true, 'message' => 'Account withdraw successfully' ]);       
    }

    public function getinterest($account_number)
    {

        $account = Account::where('account_number', $account_number)->first();

        if(is_null($account))
           return response()->json(['status' => false, 'message' => 'Account does not exist!' ]);

        if($account->amount < config('constants.options.minimum_amount_for_interest'))
            return response()->json(['status' => false, 'message' => 'Account not eligible for interest' ]);

        $account_type = AccountType::where('id', $account->account_type)->first();
    
        $interest = $account->amount * $account_type->interest_rate * 0.01;

        return response()->json(['status' => true, 'message' => 'Account accrued: '.$interest]);       
    }

    public function getaccounttypecustomers($account_type)
    {
        $customers = Account::where('account_type', $account_type)->get();
        return response()->json($customers);
    }

    public function getaccountsofcustomer($user_id)
    {
        $accounts = Account::where('user_id', $user_id)->get();
        return response()->json($accounts);
    }

    public function getaccounttypeswithzerocustomers()
    {
        $accountswithzerocustomers = [];

        $flex = Account::where('account_type', 1)->first();
        $deluxe = Account::where('account_type', 2)->first();
        $viva = Account::where('account_type', 3)->first();
        $piggy = Account::where('account_type', 4)->first();
        $supa = Account::where('account_type', 5)->first();

        if($flex == null)
            array_push($accountswithzerocustomers,"FLEX");
        if($deluxe == null)
            array_push($accountswithzerocustomers,"DELUXE");
        if($viva == null)
            array_push($accountswithzerocustomers,"VIVA");
        if($piggy == null)
            array_push($accountswithzerocustomers,"PIGGY");
        if($supa == null)
            array_push($accountswithzerocustomers,"SUPA");

        return response()->json($accountswithzerocustomers);
    }

    public function getcustomerswithzerobalance()
    {
        $users = [];

        $customers = Account::where('amount', 0)->get();

        foreach ($customers as $customer) {
            $x = User::where('user_id', $customer->user_id)->select('first_name','last_name')->first();
            $full_name = $x->first_name. ' ' . $x->last_name;
            array_push($users, $full_name);
        }
        
        return response()->json($users);
    }

    public function checkIfAccountsLimitIsExceeded()
    {
        $count = Account::where('user_id', auth()->user()->user_id)->count();
        if($count < 5)
            return false;
        else
            return true;
    }
}
