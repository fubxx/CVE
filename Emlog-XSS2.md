## Vulnerability Title: Emlog Pro 2.2.10 /admin/tag.php Stored XSS Vulnerability

- #### Vulnerability Type: Stored XSS Vulnerability
- #### Vendor Homepage: https://www.emlog.net/
- #### Software Link: https://github.com/emlog/emlog
- #### Affected Software/Version: pro 2.2.10

## Application Demo and credentials

- URL   
https://demo.emlog.cn/admin/account.php?action=signin   
username:emlog   
password:emlogpro   

## Technical Details & Exploit:

In Location "文章 >标签" and click "测试标签"
<img width="693" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/3f6bfa73-85d8-406e-828b-7be7338152cf">

paylpad:
```
<ImG sRc=x onerRor=alert(2);>
```

Click "保存"
<img width="1167" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/1a0ca56f-cb2f-4510-a35c-2839f9b78b14">
<img width="1099" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/06dbca4b-79b8-4c6b-8a95-9c9ac07c4b96">



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
