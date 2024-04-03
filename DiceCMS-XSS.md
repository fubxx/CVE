## github issue:


## Vulnerability Title: XSS vulnerabilities in Dice CMS   

- #### Vulnerability Type: XSS Injection  

- #### Vendor Homepage: https://github.com/bihell/Dice   

- #### Software Link: https://github.com/bihell/Dice   

- #### Affected Software/Version: V3.1.0   

## Application Test Demo   

- URL      
  https://dice.bigdata.icu/   

## Technical Details & Exploit:   

- location on web application   

  <img width="1292" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/b48f8a0f-668c-4073-b605-2f89db1ae21a">      
  <img width="1153" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/04f28f02-a922-4ec1-852f-99d4721b88e7">   


- payload      
  `"><img src=1 onerror=alert(1)>`
- Xss attack：   
  <img width="1159" alt="image" src="https://github.com/fubxx/CVE/assets/135971045/4ba72aa0-a950-48b0-99cb-18198002fa80">

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
