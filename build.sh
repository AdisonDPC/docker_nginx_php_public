#!/bin/bash

# Vars.
AUTHOR=adpc
NAME=nginx/php
TAG=1.0
USER=${USER}
HOME_PATH=${HOME}
PWD_PATH=$(pwd)
READ_LINK=$(readlink -f $0)
DIR_NAME=$(dirname ${READ_LINK})
ROOT_PATH=${DIR_NAME}
LOG_PATH=${ROOT_PATH}/logs

if [ ! -e ${LOG_PATH}/log.txt ]; then
  touch ${LOG_PATH}/log.txt
fi

echo "Build script is running at this date: $(date)" > ${LOG_PATH}/log.txt

echo "Current PWD_PATH: ${PWD_PATH}" >> ${LOG_PATH}/log.txt
echo "Current ROOT_PATH: ${ROOT_PATH}" >> ${LOG_PATH}/log.txt

# Build docker image.
docker build -t ${AUTHOR}/${NAME}:${TAG} --file ${ROOT_PATH}/Dockerfile ${ROOT_PATH} #>> ${LOG_PATH}/log.txt

bash ${ROOT_PATH}/run.sh
