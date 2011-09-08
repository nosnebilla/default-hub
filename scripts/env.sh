#!/bin/bash

APP_ENV="$1"

if [ -z "$APP_ENV" ]; then
  echo "Usage: env.sh ENVIRONMENT"
  
  if [ -f ./config/environment ]; then
    echo "Current environment is set to $(cat ./config/environment)"
  fi
  
  exit 0
fi

echo "Setting environment to $APP_ENV"
cat "$APP_ENV" > config/environment
