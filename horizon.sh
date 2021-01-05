#!/usr/bin/env bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

cd $DIR
echo "Current Dir: $DIR"

php artisan horizon:terminate
php artisan horizon
