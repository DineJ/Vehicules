#!/bin/bash
mkdir -p app/Entities

php spark generate:models $1
php spark generate:entity "${1}Model"
php spark generate:controller $1
php spark generate:views $1
php spark generate:routes $1
