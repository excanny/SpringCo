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
| POST   | '/register'     | register action    | route to create a new user account   | {"name": "string", "email" : "string","password" : "string"} | {"status": true,"message": "User created successfully" |
| POST | '/login'      | login action     |route to login    |{"email" : "string","password" : "string"}    | Generates an JWT authentication token and logs user into Dashboard    |
| POST | '/create/twit/'     | create twit action    | creates one twit   |{"title": "string", "body": "string"} |{ "status": true, "message": "Twit created successfully"} |
| GET | '/twits/'     | display all twits action    | displays all published twits   |None | { "_id": "string", "title": "string", "body": "string", "user_id": "string", "comments": [{ "user_id": "string", "text": "string", "date": "Tue Jan 04 2022 02:46:15 GMT+0100 (West Africa Standard Time)", "_id": "61d3a6e890d9947ad51483f8"}],"likes": ["user_id": "61d32eaed40111ba285de0dd","date": "Tue Jan 04 2022 03:07:42 GMT+0100 (West Africa Standard Time)", "_id": "string],  "createdAt": "2022-01-04T00:26:55.939Z","updatedAt": "2022-01-04T02:07:43.129Z"}] |
| POST | '/twit/'     | display one twit action    | displays a twit   | {"twit_id": "string"} | { "_id": "string", "title": "string", "body": "string", "user_id": "string", "comments": [{ "user_id": "string", "text": "string", "date": "Tue Jan 04 2022 02:46:15 GMT+0100 (West Africa Standard Time)", "_id": "61d3a6e890d9947ad51483f8"}],"likes": ["user_id": "61d32eaed40111ba285de0dd","date": "Tue Jan 04 2022 03:07:42 GMT+0100 (West Africa Standard Time)", "_id": "string],  "createdAt": "2022-01-04T00:26:55.939Z","updatedAt": "2022-01-04T02:07:43.129Z"} |
| POST | '/create/twit/comment/' | create comment action     |adds a comment to a twit    | {"comment": "string", "twit_id": "string"} |{"_id": "string", "title": "string", "body": "string", "user_id": "string", "comments": [{ "user_id": "string","text": "string", "date": "Mon Jan 03 2022 20:53:25 GMT+0100 (West Africa Standard Time)", "_id": "string"}], "likes": [], "createdAt": "2022-01-03T19:51:25.281Z", "updatedAt": "2022-01-03T19:53:26.542Z"} |
| POST   | '/create/twit/like'     | create like action    | adds like to a twit   | {"twit_id": "string"}    | { "status": true, "message": "Twit liked successfully"}    |
| POST    | '/delete/twit'      | delete twit action     | deletes a twit if created by user    |{"id": "string"}    |{ "status": true, "message": "Twit deleted successfully"}    |

