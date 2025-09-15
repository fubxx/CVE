Online Beauty Parlor Management System - SQL Injection on (/admin/add-customer.php mobilenum parameter) 

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
/admin/add-customer.php
```

On this page, `mobilenum` parameter is vulnerable to SQL Injection Attack

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
 
     
    $query=mysqli_query($con, "insert into  tblcustomers(Name,Email,MobileNumber,Gender,Details) value('$name','$email','$mobilenum','$gender','$details')");
    if ($query) {
echo "<script>alert('Customer has been added.');</script>"; 
echo "<script>window.location.href = 'add-customer.php'</script>"; 
 } else {
echo "<script>alert('Something Went Wrong. Please try again.');</script>";  	
} }
```

Proof of vulnerability(Verify using the sqlmap tool after logining):

Request:

```
POST /bpms/admin/add-customer.php HTTP/1.1
Host: localhost
Content-Length: 115
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
Referer: http://localhost/bpms/admin/add-customer.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=35oep1of4pinmqsin6t7o6nae7
Connection: keep-alive

name=1&mobilenum=12345678&gender=Female&details=1&submit=&email=test%40eyg79vwrl1iud8uly0each9aw12sqje8.oastify.com
```

<img width="1011" height="652" alt="image" src="https://github.com/user-attachments/assets/676f429d-7b00-4003-b618-038825f584c9" />




