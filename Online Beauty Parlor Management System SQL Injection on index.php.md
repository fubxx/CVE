Online Beauty Parlor Management System - SQL Injection on (/admin/index.php username parameter) 

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
/admin/index.php
```

On this page, username parameter is vulnerable to SQL Injection Attack

```
if(isset($_POST['login']))
  {
    $adminuser=$_POST['username'];
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"select ID from tbladmin where  UserName='$adminuser' && Password='$password' ");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['bpmsaid']=$ret['ID'];
     header('location:dashboard.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }
  ?>
```

Proof of vulnerability(Verify using the sqlmap tool after logining):

Request:

```
POST /bpms/admin/index.php HTTP/1.1
Host: localhost
Content-Length: 50
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
Referer: http://localhost/bpms/admin/index.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=35oep1of4pinmqsin6t7o6nae7
Connection: keep-alive

password=Test%40123&login=Sign+In&username=admin
```



<img width="986" height="659" alt="image" src="https://github.com/user-attachments/assets/09e10761-7b3f-408c-8293-3865cc7551fc" />
