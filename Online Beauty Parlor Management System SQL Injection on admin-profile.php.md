Online Beauty Parlor Management System - SQL Injection on (/admin/admin-profile.php email parameter) 

Vendor Homepage:

```
https://www.campcodes.com/projects/online-beauty-parlor-management-system/
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
/admin/admin-profile.php
```

On this page, `email` parameter is vulnerable to SQL Injection Attack


Proof of vulnerability(Verify using the sqlmap tool after logining):

Request:

```
POST /bpms/admin/admin-profile.php HTTP/1.1
Host: localhost
Content-Length: 88
Cache-Control: max-age=0
sec-ch-ua: "Not:A-Brand";v="24", "Chromium";v="134"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "macOS"
Accept-Language: zh-CN,zh;q=0.9
Origin: http://localhost
Content-Type: application/x-www-form-urlencoded
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: http://localhost/bpms/admin/admin-profile.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=35oep1of4pinmqsin6t7o6nae7
Connection: keep-alive

adminname=test&username=admin&contactnumber=7898799798&email=tester1%40gmail.com&submit=
```

<img width="1000" height="555" alt="image" src="https://github.com/user-attachments/assets/e7f5ef73-4d34-4810-a6b1-d19473927695" />




