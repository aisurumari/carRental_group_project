# carRental

For this case we are assuming that user is setting up this program on the XAMPP server.

For proper using of the email function, there is a need of editing php.ini and sendmail.ini files.

Go to C:\xampp\php and open the php.ini file. <br/>
Find [mail function] by pressing ctrl + f. <br/>
Search and pass the following values: <br/>
SMTP=smtp.gmail.com <br/>
smtp_port=587 <br/>
sendmail_from = YourGmailId@gmail.com <br/>
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t" <br/>


Now, go to C:\xampp\sendmail and open the sendmail.ini file.

Find [sendmail] by pressing ctrl + f. <br/>
Search and pass the following values <br/>
smtp_server=smtp.gmail.com <br/>
smtp_port=587 or 25 //use any of them <br/>
error_logfile=error.log <br/>
debug_logfile=debug.log <br/>
auth_username=YourGmailId@gmail.com <br/>
auth_password=Your-Gmail-Password <br/>
force_sender=YourGmailId@gmail.com(optional) <br/>
