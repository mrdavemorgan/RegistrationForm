# Simple PHP Registration/Login/Invitations

Based on the original [RegistrationForm](https://github.com/simfatic/RegistrationForm) project by simfatic.

## Installation

1. Edit the file `membersite_config.php` in the includes folder and update the configuration information (like your email address, Database login etc)
    **Note**
    The script will create the table in the database when you submit the registration form the first time. 

2. Upload the entire 'source' folder  to your web site. 
    
3. You can customize the forms and scripts as required.

## Important Files
    
* includes/membersite_config.php
    Update your confirguration information in this file
    
* includes/fg_membersite.php

    If you want to edit the email message or make changes to the logic, edit this file. (Look for "customize here" comments.)
    
* includes/class.phpmailer.php

    This script uses PHPMailer to send emails. See:http://sourceforge.net/projects/phpmailer/ 
    
 
## License
This program is free software published under the terms of the GNU [Lesser General Public License](http://www.gnu.org/copyleft/lesser.html).
You can freely use it on commercial or non-commercial websites. 
