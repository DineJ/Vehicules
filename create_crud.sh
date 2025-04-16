#!/bin/bash

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

		php spark generate:models $@
		php spark generate:entity "${1}Model"
		php spark generate:controller $@
		php spark generate:views $@
		php spark generate:routes $@
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

