Docker-compose template
====

Basic stack to serve web application. Using Nginx, php, mysql with phpMyAdmin

## Notice: 
use PHP 7.1.6

## Installation: 

First, clone repository :
`$ git clone git@github.com:darkiron/docker-compose.git`

Install, project file, in `dev` folder

## Run :
lunch containers : `docker-compose up`
goto the url: `localhost:8888`
   

## phpMyAdmin: 
goto the url: `localhost:76`
use root login/password : `root`

### Memory cheat

console access :
`docker-compose exec php /bin/sh`
