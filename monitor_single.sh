#!/bin/bash

# Vars.
AUTHOR=adpc
NAME=nginx/php
TAG=1.0
PORT_80=8080

# Monitor docker container.

# docker exec -it ${DOCKER_NAME} bash

if [ $# -lt 1 ]
then

  echo 'ERROR: No argument supplied';
  echo 'SYNTAX: '${0}' <DOCKER_NAME>';

else

  DOCKER_NAME=${1}

  # SITE

  docker exec -it ${DOCKER_NAME} bash

fi
