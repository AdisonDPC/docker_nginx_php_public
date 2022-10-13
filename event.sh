#!/bin/bash

docker events --filter 'type=container' --format 'Type={{.Type}} Status={{.Status}} ID={{.ID}}';
