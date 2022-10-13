#!/bin/bash

# Vars.
AUTHOR=adpc
NAME=nginx/php
TAG=1.0

# Stop docker container.

# DOCKER_NAME='<DOCKER_NAME>'

# docker stop ${DOCKER_NAME}

if [ $# -lt 1 ]
then

  echo 'ERROR: No argument supplied';
  echo 'SYNTAX: '${0}' <DOCKER_NAME>';

else

  DOCKER_NAME=${1}

  # SITE

  docker stop ${DOCKER_NAME}

fi
