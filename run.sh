#!/bin/bash
docker run -d -p 27017-27019:27017-27019 --name validator_mongodb -v "$PWD/db":/data/db mongo:4.0.4
docker run -d -p 8080:80 -p 8081:8081 --link validator_mongodb  --name validator_backend -v "$PWD/backend":/var/www/html validator_api
