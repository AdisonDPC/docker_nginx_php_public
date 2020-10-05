#!/bin/bash

# Vars.
AUTHOR=adpc
NAME=nginx/php
TAG=1.0
PORT_80=8080

docker exec -it ${AUTHOR}_$(echo "${NAME}" | tr '/' '_') bash
