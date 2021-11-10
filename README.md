# ViBiBa

# Citation
Asperger H, Cieslik JP, Alberter B, Köstler C, Polzer B, Müller V, Pantel K, Riethdorf S, Koch A, Hartkopf A, Wiesmüller L, Janni W, Schochter F, Franken A, Niederacher D, Fehm T, Neubauer H. ViBiBa: Virtual BioBanking for the DETECT multicenter trial program - decentralized storage and processing. Transl Oncol. 2021 Aug;14(8):101132. doi: 10.1016/j.tranon.2021.101132. Epub 2021 May 27. PMID: 34051621; PMCID: PMC8176360.

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
# Basic usage
We recommend getting started with the demo docker-compose installation.
Not all administrative features are yet available through the Web-App but the included phpmyadmin installation allows for easy adjustment.

# Production Environment
We recommend setting up a dedicated mysql server and connecting the docker instance with the external mysql server.
Alternatively, you can expose the /public/ directory through a web server of your choice. Please note that Xdebug is enabled by default and should be switched off.
# License
ViBiBa is released under the MIT license. A copy of the license text is included in the repository.
Please note that the software is distributed "as is" and we cannot and do not take liability for any errors and possible malfunctions caused by the software. 
