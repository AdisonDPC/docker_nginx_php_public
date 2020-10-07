#!/bin/bash

# Vars.
AUTHOR=adpc
NAME=nginx/php
TAG=1.0

# Stop docker container.

docker stop ${AUTHOR}_$(echo "${NAME}" | tr '/' '_')
