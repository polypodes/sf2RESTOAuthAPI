all: help

help:
	@echo
	@echo "Available tasks:"
	@echo
	@echo "\tTo create db: make createDb"
	@echo "\tTo drop db: make dropDb"
	@echo "\tTo clear cache: make clear"
	@echo "\tTo run behat tests: make behat"
	@echo

dropDb:
	@echo
	@echo "Drop database..."
	@php app/console doctrine:database:drop --force

createDb:
	@echo
	@echo "Create database..."
	@php app/console doctrine:database:create
	@php app/console doctrine:schema:update --force

clear:
	@echo
	@echo "Resetting cache..."
	@php app/console cache:clear

reset: dropDb createDb clear

behat:
	bin/behat --lang=fr  "@LesPolypodesRestOAuthBundle"
