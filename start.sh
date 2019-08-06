#!/bin/bash

echo Starting MongoDB...
docker  start validator_mongodb
echo MongoDB validator started...
echo Starting Backend
docker start validator_backend
docker exec -it validator_backend php -S 0.0.0.0:8081 -t /var/www/html/api/public
echo Backend Started
