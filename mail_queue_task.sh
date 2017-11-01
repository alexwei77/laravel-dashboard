#!usr/bin/env bash

MAXTASKS=1
SDIR=$(cd `dirname $0` && pwd)
cd $SDIR

runningTasks=`ps aux|grep -v grep | grep -c "queue:work"`
if [ "$runningTasks" -lt "$MAXTASKS" ]; then
  echo "Mail queue task is _not_ currently running... starting it up"
  php artisan queue:work --once
else
  echo "Mail queue task is already running"
fi
