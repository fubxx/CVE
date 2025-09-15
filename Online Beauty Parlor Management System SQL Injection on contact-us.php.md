Online Beauty Parlor Management System - SQL Injection on (/admin/contact-us.php mobnumber parameter) 

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
/admin/contact-us.php
```

On this page, `mobnumber` parameter is vulnerable to SQL Injection Attack

<img width="1098" height="679" alt="image" src="https://github.com/user-attachments/assets/856d1adb-a415-4b68-8dd0-864c768a8710" />


Proof of vulnerability(Verify using the sqlmap tool after logining):

Request:

```
POST /bpms/admin/contact-us.php HTTP/1.1
Host: localhost
Content-Length: 182
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
Referer: http://localhost/bpms/admin/contact-us.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=35oep1of4pinmqsin6t7o6nae7
Connection: keep-alive

pagetitle=Contact+Us&email=info%40gmail.com&mobnumber=7896541236&timing=10%3A30+am+to+7%3A30+pm&pagedes=++++++++890%2CSector+62%2C+Gyan+Sarovar%2C+GAIL+Noida%28Delhi%2FNCR%29&submit=
```

<img width="1002" height="645" alt="image" src="https://github.com/user-attachments/assets/a12c30f5-e295-4251-b367-1026f2beee68" />




