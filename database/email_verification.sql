/***
    Selecting the row where email and token is passed
    Usage of ? (Prepared statements) for security purposes
***/
SELECT email, token, verified FROM users WHERE email=? AND token=? AND verified='0'

/***
    Updating the verified column to 1 if the email and token is verified
***/

UPDATE users SET verified='1' WHERE email=? AND verified='0'