# ViBiBa

# Cite
While our manuscript is under submission, please cite:
H Asperger, J-P Cieslik et al. (2021) "ViBiBa: Virtual BioBanking for the DETECT multicenter trial program - decentralized storage and processing" Manuscript submitted for publication
# Getting Started
For development and testing purposes we have built this repository around docker integration.
The included docker-compose file will create :
* mysql container with a demo database stored under "mysql_dump/init.sql"
* www container (port 80) with a custom apache build with enabled XDebug for development purposes (the docker build file is included
* phpmyadmin container (port 8000) with a default installation of phpmyadmin for testing purposes
* php-composer container to execute php-compose install/update on start up for easy installation of dependencies
```
git clone asperciesl/ViBiBa
cd ViBiBa
docker-compose up
```
For production mode please run
````
docker-compose -f  docker-compose-prod.yml up
````
On startup the mysql_dump/init.sql is automatically imported into the mysql docker container. When using persistent storage, the init.sql file won't be considered in consecutive startups.
To overwrite the existing database you have to delete the persistent container e.g.:
````
docker volume rm vibiba_persistent
````
# Basic usage
We recommend getting started with the demo docker-compose installation.
Not all administrative features are yet available through the Web-App but the included phpmyadmin installation allows for easy adjustment.

# Production Environment
We recommend setting up a dedicated mysql server and connecting the docker instance with the external mysql server.
Alternatively, you can expose the /public/ directory through a web server of your choice. Please note that Xdebug is enabled by default and should be switched off.
We have created a basic production environment docker-compose file (see above).
# License
ViBiBa is released under the MIT license. A copy of the license text is included in the repository.
Please note that the software is distributed "as is" and we cannot and do not take liability for any errors and possible malfunctions caused by the software. 
