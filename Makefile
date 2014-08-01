all: help

help:
	@echo
	@echo "Available tasks:"
	@echo
	@echo "\tTo create db: make createDb"
	@echo "\tTo drop db: make dropDb"
	@echo "\tTo clear cache: make clear"
	@echo "\tTo install all db/assets/vendors needed: make install"
	@echo "\tTo reset all db/assets: make reset"
	@echo "\tTo set up a test-otiented database (do a reset): make fixtures"
	@echo "\tTo run behat tests: make behat"
	@echo

init:
	@echo
	@composer install --dev --optimize-autoloader

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

install: init createDb
	@echo
	@echo "Installing db & schema..."

done:
	@echo
	@echo "Done."

fixtures: reset
	@echo
	@echo "Resetting instance & installing fixtures..."
	@php app/console h4cc_alice_fixtures:load:sets

reset: dropDb install

behat:
	bin/behat --suite=api_suite