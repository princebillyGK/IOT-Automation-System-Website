# IOT Automation System

##### Website  link: <a href="princebillywebwork.epizy.com" target="_blank">Passport Application System</a>

#### Features:

1. This website is developed to works with esp8266 to show data from sensors and control electric switches

   ![IOT AS DEVICE](https://i.imgur.com/oi3mpfb.jpg)

2. Admin can add and remove switches, sensors and new users as much as they wishes.

3. Machine can add new sensors to database and update their value by browsing update_machine.php file.

   > browsing  ....../update_machine.php will track ip of the machine.
   >
   > browsing ...../update_machine.php?x1=<value>&x2=<value>&.... will update value of sensor x1,x2,... if they are already exists otherwise it will create new sensors named x1,x2,... and assign their value.

4. Machine can watch and update switch status by browsing stat_machine.php file. 

5. This can website track the location of machine when it access the website and show its location in google map 

6. Require username and password for login

7. Only admin can access the settings page other users can see sensor values and control the switches. ***Default(can only be changed from database) admin username: "admin" password: "116331" to access the website***

#### Used Technologies:

	HTML, SCSS, JS, JQuery, Bootstrap, php, gulp, npm, photoshop

> ***princebilllyGK***

