#!/bin/sh

ENV="$1"

if [ -z "$ENV" ]; then
  echo "Usage: create_mysql_db.sh ENV"
  exit 1
fi

DB="fn_register_$ENV"
OPTS=""

if [ "$ENV" == "production" ]; then
  OPTS="-u db281288 -p NhGRqMSW9J"
  DB="db281288"
fi

echo "* Creating database '$DB'..."
mysql5 -e "CREATE DATABASE $DB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

echo "* Creating table 'activations'..."
mysql5 $OPTS "$DB" < db/mysql/create_activations.sql
echo "* Creating table 'licenses'..."
mysql5 $OPTS "$DB" < db/mysql/create_licenses.sql
echo "* Creating tables 'orders'..."
mysql5 $OPTS "$DB" < db/mysql/create_orders.sql
echo "* Creating tables 'products'..."
mysql5 $OPTS "$DB" < db/mysql/create_products.sql
echo "* Creating tables 'trials'..."
mysql5 $OPTS "$DB" < db/mysql/create_trials.sql
echo "* Inserting products..."
mysql5 $OPTS "$DB" < db/mysql/insert_products.sql
echo "Done!"
