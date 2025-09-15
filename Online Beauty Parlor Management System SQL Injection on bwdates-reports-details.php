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
/admin/index.php
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






