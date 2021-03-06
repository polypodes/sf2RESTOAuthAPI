#
# Makefile
# Les Polypodes, 2014-08-06 15:41
# Licence: MIT
# Source: https://github.com/polypodes/Deploy/blob/master/Symfony2/Makefile

# Usage:

# me@myserver$~: make help
# me@myserver$~: make pull
# me@myserver$~: make install
# me@myserver$~: make sniff
# me@myserver$~: make codecoverage
# etc.

############################################################################
# Vars

# some lines may be useless for now, but these are nice tricks:
PWD         := $(shell pwd)
VENDOR_PATH := $(PWD)/vendor
BIN_PATH    := $(PWD)/bin
NOW         := $(shell date +%Y-%m-%d--%H-%M-%S)
REPO        := "https://github.com/..."
BRANCH      := 'master'
# Colors
YELLOW      := $(shell tput bold ; tput setaf 3)
GREEN       := $(shell tput bold ; tput setaf 2)
RESETC      := $(shell tput sgr0)

############################################################################
# Mandatory tasks:
vendor/autoload.php:
	composer install --optimize-autoloader

############################################################################
# Specific, project-related sf2 tasks:

integration:
	@echo
	@cd integration
	@gulp build
	@cd ../

data: vendor/autoload.php
	@echo "Install initial datas..."
	@app/console dbal:data:initialize --purge

fixtures: vendor/autoload.php
	@echo "Install fixtures in db..."
	@php app/console h4cc_alice_fixtures:load:sets

############################################################################
# Generic sf2 tasks:

help:
	@echo
	@echo "${GREEN}Usual tasks:${RESETC}"
	@echo
	@echo "\tTo install: make install"
	@echo "\tTo reinstall: make reinstall"

	@echo "${GREEN}Other specific tasks:${RESETC}"
	@echo
	@echo "\tTo deploy: make deploy"
	@echo "\tTo clear all caches: make clear"
	@echo "\tTo run tests: make tests"
	@echo

check:
	@php app/check.php

all: vendor/autoload.php check help

pull:
	@git pull origin $(BRANCH)


dropDb: vendor/autoload.php
	@echo
	@echo "Drop database..."
	@php app/console doctrine:database:drop --force

createDb: vendor/autoload.php
	@echo
	@echo "Create database..."
	@php app/console doctrine:database:create
	@php app/console doctrine:schema:update --force

schemaDb: vendor/autoload.php
	@echo
	@echo "Configure database schema..."
	@php app/console doctrine:schema:update --force

assets:
	@echo "\nPublishing assets..."
	@php app/console assets:install --symlink

clear: vendor/autoload.php
	@echo
	@echo "Resetting caches..."
	@php app/console cache:clear --env=prod --no-debug
	@php app/console cache:clear --env=dev

explain:
	@echo "git pull origin master + update db schema + build integration + copy new assets + rebuild prod cache"
	@echo "Note you can change the git remote repo username in .git/config"

behavior: vendor/autoload.php
	@echo "Run behavior tests..."
#	bin/behat --lang=fr  "@AcmeDemoBundle"
	bin/behat --suite=api_suite

unit: vendor/autoload.php
	@echo "Run unit tests..."
	@php bin/phpunit -c build/phpunit.xml -v

codecoverage: vendor/autoload.php
	@echo "Run coverage tests..."
	@bin/phpunit -c build/phpunit.xml -v --coverage-html ./build/codecoverage

continuous: vendor/autoload.php
	@echo "Starting continuous tests..."
	@while true; do bin/phpunit -c build/phpunit.xml -v; done

sniff: vendor/autoload.php
	bin/phpcs --standard=PSR2 src -n

quality:
	@echo "Starting code check-up..."
	# phploc: https://github.com/sebastianbergmann/phploc
	# phpmd: https://github.com/phpmd/phpmd
	# phpcpd: https://github.com/sebastianbergmann/phpcpd
	# pdepend: https://github.com/pdepend/pdepend
	# php-cs-fixer: https://github.com/fabpot/PHP-CS-Fixer
	@phploc src
	@phpcs --standard=build/phpcs.xml src
	@phpmd src text codesize,unusedcode,naming
	@phpcpd src
	@pdepend src
	@php-cs-fixer fix src --dry-run

deploy: vendor/autoload.php
	@echo "UPDATING using git pull origin $(BRANCH) + update db schema + rebuild prod cache..."
	@echo "Note you can change the git remote repo username in .git/config"
	@git pull origin $(BRANCH)
	@$(MAKE) schemaDb
	@php app/console cache:clear --env=prod --no-debug

done:
	@echo
	@echo "${GREEN}Done.${RESETC}"

# Tasks sets:

all: vendor/autoload.php check

prepareDb: createDb schemaDb

purgeDb: dropDb createDb schemaDb

#install: prepareDb data assets clear done
install: prepareDb clear done

reinstall: dropDb install

tests: reinstall fixtures behavior unit codecoverage

deploy: explain install done


############################################################################
# .PHONY tasks list

.PHONY: integration data fixtures help check all pull dropDb createDb
.PHONY: schemaDb assets clear explain behavior unit codecoverage 
.PHONY: continuous sniff quality deploy done prepareDb purgeDb
.PHONY: install reinstall test deploy
# vim:ft=make