Impoertant commands to have in mind 

open xammp using the terminal : sudo /opt/lampp/manager-linux-x64.run
start xammp servers : sudo /opt/lampp/lampp start
stop apache : sudo systemctl stop apache2
check the status of xammp servers : sudo /opt/lampp/lampp status

To resolve the error of phpmyadmin not loading , you need to stop the default apache2 using the command 'sudo systemctl stop apache2', then start the xammp servers on the GUI and configure the port to port 80 and that will work work fine 
