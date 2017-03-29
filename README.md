PHP script using REST to interact with a database

TO USE:

1. Open the script and enter the infmation about your database towards the bottom. (IP address, username, password, and database name)
2. To use to script use the format 'curl localhost/<username>/<firstname>/<lastname>/<age>/<email>/<zipcode> -X [POST | PUT]'
3. To delete data from the database 'curl localhost/<username> -X DELETE'
$. To look at infromation from a user in the database 'curl localhost/<username> -X GET'
