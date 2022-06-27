<h1 align="center">
    
    SpringCo
</h1>



## About SpringCo

SpringCo, one of the leading Fintech companies in Nigeria, is expanding her customer base by 20% in the next 6 months.
To achieve their goal, SpringCo recently came up with 5 different account products.
FLEX, DELUXE, VIVA, PIGGY, SUPA. 

## Using SpringCo on POSTMAN
After the JWT is generated upon a successful login, use "Authorization : 'generated.jwttoken.value'" to access the protected routes in POSTMAN

## Routes Overview

| HTTP Verb    | Route          | Action | Used For    | Request | Expected Response/Action |
| :---:         |     :---:      |         :---: | :---: |  :---: | :---: |
| POST   | '/api/register'     | register action    | route to create a new user account   | {"first_name": "string", "first_name": "string", "email" : "string","password" : "string"} | {"status": true,"message": "User created successfully" |
| POST | '/api/login'      | login action     |route to login    |{"email" : "string","password" : "string"}    | Generates an JWT authentication token and call other endpoints   /api/accounts'     | create account action    | creates one account   |{"account_type": "number"} |{ "status": true, "message": "Twit created successfully"} |
| PUT | '/api/accounts/fund/{account_number}'     | funds a account    | account funding   |None | { "deposit_amount": "number"} |
| PUT | '/api/accounts/withdraw/{account_number}'     | withdraws from an account    | account withdrawal   | { "withdraw_amount": "number"} |
| GET | '/api/accounts/getinterest/{account_number}' | gets accrued interest on account     |interest calculation    |  |
| POST   | '/create/twit/like'     | create like action    | adds like to a twit   | {"twit_id": "string"}    | { "status": true, "message": "Twit liked successfully"}    |
| POST    | '/delete/twit'      | delete twit action     | deletes a twit if created by user    |{"id": "string"}    |{ "status": true, "message": "Twit deleted successfully"}    |

