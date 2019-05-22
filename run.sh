#!/bin/bash

# Vars.
AUTHOR=adpc
NAME=nginx/php
TAG=1.0  
PORT_80=8080
USER=${USER}
HOME_PATH=${HOME} 
PWD_PATH=$(pwd)
READ_LINK=$(readlink -f $0)
DIR_NAME=$(dirname ${READ_LINK})
ROOT_PATH=${DIR_NAME}
LOG_PATH=${ROOT_PATH}/logs
SITE_PATH=${ROOT_PATH}/site
CONFIG_PATH=${ROOT_PATH}/config

# Run docker container.

# Use in Development.
# docker run --name ${AUTHOR}_$(echo "${NAME}" | tr '/' '_') -it --rm -p ${PORT_80}:80 -v ${SITE_PATH}:/var/www/html ${AUTHOR}/${NAME}:${TAG}
docker run --name ${AUTHOR}_$(echo "${NAME}" | tr '/' '_') -it --rm -p ${PORT_80}:80 -v ${SITE_PATH}:/var/www/html ${AUTHOR}/${NAME}:${TAG}

# Use in Production.
# docker run --name ${AUTHOR}_$(echo "${NAME}" | tr '/' '_') -d -it --rm -p ${PORT_80}:80 -v ${SITE_PATH}:/var/www/html ${AUTHOR}/${NAME}:${TAG}
