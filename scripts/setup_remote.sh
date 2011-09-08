#!/bin/sh
#
# deploy GIT_REV
# deploy --production GIT_REV
# 

ENV="$1"

if [ -z "$ENV" ]; then
  echo "Usage: setup_remote.sh production|staging"
  exit 1
fi

PRODUCTION_PATH="apps/register"
STAGING_PATH="apps/register_staging"

if [ "$ENV" == "production" ]; then
  TARGET="$PRODUCTION_PATH"
else
  TARGET="$STAGING_PATH"
fi

echo "* Creating deployment directories in $TARGET..."
ssh ssh-281288-fn@flanders.fournova.com "mkdir -p $TARGET/releases"
ssh ssh-281288-fn@flanders.fournova.com "mkdir $TARGET/shared;chmod 777 $TARGET/shared"
ssh ssh-281288-fn@flanders.fournova.com "mkdir $TARGET/shared/tmp;chmod 777 $TARGET/shared/tmp"
ssh ssh-281288-fn@flanders.fournova.com "mkdir $TARGET/shared/var;chmod 777 $TARGET/shared/var"
ssh ssh-281288-fn@flanders.fournova.com "mkdir $TARGET/shared/log;chmod 777 $TARGET/shared/log"
