Online Beauty Parlor Management System - SQL Injection on (/admin/edit-services.php editid parameter) 

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

On this page, `editid` parameter is vulnerable to SQL Injection Attack

```
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $sername=$_POST['sername'];
    $cost=$_POST['cost'];
   
 $eid=$_GET['editid'];
     
    $query=mysqli_query($con, "update  tblservices set ServiceName='$sername',Cost='$cost' where ID='$eid' ");
    if ($query) {
    $msg="Service has been Updated.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

  
}
  ?>
```

Proof of vulnerability(Verify using the sqlmap tool after logining):

Request:

```
GET /bpms/admin/edit-services.php?editid=1asd HTTP/1.1
Host: localhost
sec-ch-ua: "Not:A-Brand";v="24", "Chromium";v="134"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "macOS"
Accept-Language: zh-CN,zh;q=0.9
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: http://localhost/bpms/admin/manage-services.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=35oep1of4pinmqsin6t7o6nae7
Connection: keep-alive
```

<img width="960" height="626" alt="image" src="https://github.com/user-attachments/assets/f36c9b90-6cd1-448a-8749-f1349bb150f1" />




