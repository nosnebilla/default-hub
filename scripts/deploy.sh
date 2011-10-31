#!/bin/sh
#
# deploy GIT_REV
# deploy --production GIT_REV
# 

NOW=$(date +"%Y%d%m%H%M%S")
RELEASE="$1"
RELEASE_FILE="$1-$NOW"

if [ -z "$RELEASE" ]; then
  echo "Usage: deploy.sh RELEASE"
  exit 1
fi

ARCHIVE="$RELEASE_FILE.zip"
PRODUCTION_PATH="apps/webapp_macappsregister"
RELEASES_PATH="$PRODUCTION_PATH/releases/"
DEPLOY_TO="$RELEASES_PATH/$RELEASE_FILE"

# Create archive with required directories
git archive -o $ARCHIVE $RELEASE app/ db/ config/ lib/ public/ scripts/

# ssh: create new release on flanders
echo "* Creating new release..."
ssh ssh-281288-fn@flanders.fournova.com "mkdir -p $DEPLOY_TO"
scp $ARCHIVE ssh-281288-fn@flanders.fournova.com:$DEPLOY_TO
ssh ssh-281288-fn@flanders.fournova.com "cd $DEPLOY_TO;unzip $ARCHIVE;rm -f $ARCHIVE"

# ssh: create links for shared stuff
echo "* Creating links for shared stuff..."
ssh ssh-281288-fn@flanders.fournova.com "cd $DEPLOY_TO;ln -s ../../shared/log"
ssh ssh-281288-fn@flanders.fournova.com "cd $DEPLOY_TO;ln -s ../../shared/tmp"
ssh ssh-281288-fn@flanders.fournova.com "cd $DEPLOY_TO;ln -s ../../shared/var"

# ssh: update current link
echo "* Updating current link..."
ssh ssh-281288-fn@flanders.fournova.com "cd $PRODUCTION_PATH;rm -f current;ln -s releases/$RELEASE_FILE current;"

rm -f $ARCHIVE
