<?php
namespace App\Http\Traits;
use App\Models\Account;
trait AccountTrait {
    public function generateAccountNumber()
    {
        //$account_number = mt_rand( 0, 9999999999 );
        $account_number = str_pad(rand(0,9999999999), 10, "0", STR_PAD_LEFT);
        $exist = Account::where( 'account_number', $account_number)->exists();
        if(!$exist)
            return $account_number;
        else
            generateAccountNumber();
    }
}