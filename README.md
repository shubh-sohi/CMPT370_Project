# Rock A Job

# To run the web app do the following
* Clone or Download the repository
* Make sure that you have docker installed in your system
* Using your command line(Terminal in mac) cd into the Web Application folder
* While being in the Web Application type the following two commands to build the dockerimage first and then make the docker container
    * `docker build . -t php-sql/shubh-php-mysql-demo:1.0.0`
    * `docker-compose up --build`
* The web page is now hosted on http://localhost:30001/index/ along with myphpadmin on localhost:30002(which will display the database).
* The login for myphpadmin is as follows:
    * username - shubhuser
    * password - shubhpass
