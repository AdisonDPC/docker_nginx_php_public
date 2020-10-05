#!/bin/bash

# Vars.
AUTHOR=adpc
NAME=nginx/php
TAG=1.0
PORT_80=8080
PORT_443=4430
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

# SERVER_ADDR='<SERVER_ADDR>'

# VIRTUAL_HOST='<VIRTUAL_HOST>'
# VIRTUAL_VOLUME='<VIRTUAL_HOST>'
# VIRTUAL_PORT_80='<VIRTUAL_PORT_80>'
# VIRTUAL_PORT_443='<VIRTUAL_PORT_443>'

# Use in Development.
# docker run --name ${AUTHOR}_$(echo "${NAME}" | tr '/' '_') -it --rm -e SERVER_ADDR=${SERVER_ADDR} -e VIRTUAL_HOST=${VIRTUAL_HOST} -e VIRTUAL_TYPE=wordpress -p ${VIRTUAL_PORT_80}:80 -p ${VIRTUAL_PORT_443}:443 -v ${VIRTUAL_VOLUME}:/var/www/html ${AUTHOR}/${NAME}:${TAG}

# Use in Production.
# docker run --name ${AUTHOR}_$(echo "${NAME}" | tr '/' '_') -d -it --rm -e SERVER_ADDR=${SERVER_ADDR} -e VIRTUAL_HOST=${VIRTUAL_HOST} -e VIRTUAL_TYPE=wordpress -p ${VIRTUAL_PORT_80}:80 -p ${VIRTUAL_PORT_443}:443 -v ${VIRTUAL_VOLUME}:/var/www/html ${AUTHOR}/${NAME}:${TAG}

SERVER_ADDR='192.168.1.111'

# SITE

VIRTUAL_HOST='slim.adpcprojects.docker.com'
VIRTUAL_VOLUME=${SITE_PATH}'/slim_test_v1'
VIRTUAL_PORT_80=8080
VIRTUAL_PORT_443=4430

docker run --name ${AUTHOR}_$(echo "${NAME}" | tr '/' '_') -it --rm -e SERVER_ADDR=${SERVER_ADDR} -e VIRTUAL_HOST=${VIRTUAL_HOST} -e VIRTUAL_TYPE=slim -p ${VIRTUAL_PORT_80}:80 -p ${VIRTUAL_PORT_443}:443 -v ${VIRTUAL_VOLUME}:/var/www/html ${AUTHOR}/${NAME}:${TAG}
