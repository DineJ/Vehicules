#!/bin/bash
sudo chown -Rf $USER:$USER .

function help()
{
	scriptname=$(basename "$0")
	echo "How to use ${scriptname} : ${scriptname} create <entityname> [field1,field2,field3,...]"
	echo "                            ${scriptname} rm <entityname>"
}

# arg=un deux trois quatre
action=$1
shift
# arg=deux trois quatre
case $action in

 "create")
	if [ $# -lt 1 ]; then
		echo "Nombre d'argument insuffisant"
	 	help
	else
		mkdir -p app/Entities

		docker compose exec php-fpm php spark generate:models $@
		docker compose exec php-fpm php spark generate:entity "${1}Model"
		docker compose exec php-fpm php spark generate:controller $@
		docker compose exec php-fpm php spark generate:views $@
		docker compose exec php-fpm php spark generate:routes $@
	fi
    ;;

  "rm")
	if [ $# -ne 1 ]; then
		echo "Nombre d'argument insuffisant"
		help
	else
		entity=${1^}
		rm -riv app/Views/$entity/*.php  app/Entities/${entity}.php app/Models/${entity}Model.php app/Controllers/${entity}Controller.php
	fi
    ;;
esac

