#!/bin/sh

ENV="$1"

if [ -z "$ENV" ]; then
  echo "Usage: create_db.sh ENV"
  exit 1
fi

DB="var/db/$ENV.sqlite3"

if [ -f "$DB" ]; then
  echo "Database $DB already exists!"
  exit 1
else 
  touch "$DB"
fi

echo "* Creating $DB..."
sqlite3 "$DB" < db/sqlite/create_products.sql
sqlite3 "$DB" < db/sqlite/create_orders.sql
sqlite3 "$DB" < db/sqlite/create_licenses.sql
sqlite3 "$DB" < db/sqlite/create_activations.sql
sqlite3 "$DB" < db/sqlite/create_trials.sql
sqlite3 "$DB" < db/sqlite/create_users.sql
sqlite3 "$DB" < db/sqlite/insert_products.sql
sqlite3 "$DB" < db/sqlite/insert_users.sql

echo "* Running chmod 666 $DB..."
chmod 666 "$DB"
