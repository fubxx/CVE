Online Beauty Parlor Management System - SQL Injection on (/admin/edit-customer-detailed.php editid parameter) 

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
/admin/edit-customer-detailed.php
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
   $name=$_POST['name'];
    $email=$_POST['email'];
   $mobilenum=$_POST['mobilenum'];
    $gender=$_POST['gender'];
$details=$_POST['details'];
   
 $eid=$_GET['editid'];
     
    $query=mysqli_query($con, "update  tblcustomers set Name='$name',Email='$email',MobileNumber='$mobilenum',Gender='$gender',Details='$details' where ID='$eid' ");
    if ($query) {
    $msg="Customer Detail has been Updated.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

  
}
```

<img width="1313" height="486" alt="image" src="https://github.com/user-attachments/assets/826eda89-b24d-41bd-bce9-f49389446c0c" />


Proof of vulnerability(Verify using the sqlmap tool after logining):

Request:

```
POST /bpms/admin/edit-customer-detailed.php?editid=1 HTTP/1.1
Host: localhost
Content-Length: 113
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
Referer: http://localhost/bpms/admin/edit-customer-detailed.php?editid=1
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=35oep1of4pinmqsin6t7o6nae7
Connection: keep-alive

name=Sunita+Verma&email=verma%40gmail.com&mobilenum=5546464646&gender=Transgender&details=Taking+Hair+Spa&submit=
```

<img width="962" height="641" alt="image" src="https://github.com/user-attachments/assets/ed04f9f9-f3a3-4509-9ad7-0d988d1d06f4" />




