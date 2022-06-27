<h1 align="center">
    
    SpringCo
</h1>



## About SpringCo

SpringCo, one of the leading Fintech companies in Nigeria, is expanding her customer base by 20% in the next 6 months.
To achieve their goal, SpringCo recently came up with 5 different account products.
FLEX, DELUXE, VIVA, PIGGY, SUPA. 

## Using SpringCo on POSTMAN
After the JWT is generated upon a successful login, use "Authorization : 'Bearer + generated.jwttoken.value'" to access the protected routes in POSTMAN

## Routes Overview

| HTTP Verb    | Route          | Action | Used For    | Request | Expected Response/Action |
| :---:         |     :---:      |         :---: | :---: |  :---: | :---: |
| POST   | '/api/register'     | register action    | route to create a new user account   | {"first_name": "string", "first_name": "string", "email" : "string","password" : "string"} | {"status": true,"message": "User created successfully" |
| POST | '/api/login'      | login action     |route to login    |{"email" : "string","password" : "string"}    | Generates an JWT authentication token and call other endpoints   /api/accounts'     | create account action    | creates one account   |{"account_type": "number"} |{ "status": true, "message": "Account created successfully"} |
| PUT | '/api/accounts/fund/{account_number}'     | fund action    | funds a account   |{ "deposit_amount": "number"} | { "status": true, "message": "Account funded successfully"} |
| PUT | '/api/accounts/withdraw/{account_number}'     | withdraw action    | withdraws from an account   | { "withdraw_amount": "number"} | { "status": true, "message": "Account withdrawn successfully"}|
| GET | '/api/accounts/getinterest/{account_number}' | interest calculation action | calculates accrued interest on an account   | None | {"status":true,"message":"Account accrued: 3499.3"}|
| GET   | '/api/accounts/getaccounttypecustomers/{account_type_id}'     | account type customers retrieval action   | get customers under the account type   | None    | [A list of customers]    |
| GET | '/api/accounts/getaccountsofcustomer/{user_id}' | customer's accounts retrieval action | get accounts of a customer    | None  | [A list of the customer's accounts]  |
| GET | '/api/accounts/getaccounttypeswithzerocustomers' | account types with zero customers retrieval action | gets any account type thats has no customers    | None  | [A list of the account types with no customers]  |
| GET | 'api/accounts/getaccountswithzerobalance' | accounts with zero balance retrieval    | get accounts with zero balance   | None  | [A list of the accounts with zero balance]  |
