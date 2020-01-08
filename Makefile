# Version config
TAG := $(shell git tag --points-at HEAD | sort --version-sort | tail -n 1)
LASTTAG := $(or $(shell git tag -l | sort -r -V | head -n 1),0.1.0)
SNAPINFO := $(shell date +%Y%m%d%H%M%S)git$(shell git log -1 --pretty=%h)
RELEASE := $(or $(BUILD_NUMBER), 1)
VERSION := $(or $(TAG:v%=%),$(LASTTAG:v%=%))-$(or $(BUILD_NUMBER), 1)$(if $(TAG),,.$(SNAPINFO))

# Executables
DOCKER = docker
PHP = php
PHPUNIT = ./vendor/bin/phpunit
SED = sed

# Integration test config
export BC_TEST_DELAY := 5
IMAGE := circleci/php:7.4
SCMROOT := $(shell git rev-parse --show-toplevel)
PWD := $(shell pwd)
CACHE := $(HOME)/.local/share/blockchyp/itest-cache
CONFIGFILE := $(HOME)/.config/blockchyp/sdk-itest-config.json
CACHEPATHS := $(dir $(CONFIGFILE)) $(HOME)/.composer
ifeq ($(shell uname -s), Linux)
HOSTIP = $(shell ip -4 addr show docker0 | grep -Po 'inet \K[\d.]+')
else
HOSTIP = host.docker.internal
endif

# Default target
.PHONY: all
all: clean build

# Cleans build artifacts
.PHONY: clean
clean:
	$(RM) -rf vendor

# Compiles the package
.PHONY: build
build: lint

# Runs unit tests
.PHONY: test
test:
	$(PHPUNIT) --bootstrap vendor/autoload.php --exclude-group itest tests

# Runs integration tests
.PHONY: integration
integration:
	$(if $(LOCALBUILD), \
		$(PHPUNIT) --bootstrap vendor/autoload.php --group itest tests, \
		$(foreach path,$(CACHEPATHS),mkdir -p $(CACHE)/$(path) ; ) \
		sed 's/localhost/$(HOSTIP)/' $(CONFIGFILE) >$(CACHE)/$(CONFIGFILE) ; \
		$(DOCKER) run \
		-u $(shell id -u):$(shell id -g) \
		-v $(SCMROOT):$(SCMROOT):Z \
		-v /etc/passwd:/etc/passwd:ro \
		$(foreach path,$(CACHEPATHS),-v $(CACHE)/$(path):$(path):Z) \
		-e BC_TEST_DELAY=$(BC_TEST_DELAY) \
		-e HOME=$(HOME) \
		-w $(PWD) \
		--init \
		--rm -it $(IMAGE) \
		bash -c "composer install -n --prefer-dist && $(PHPUNIT) --bootstrap vendor/autoload.php $(if $(TEST),--filter $(TEST),--group itest tests)")

# Performs any tasks necessary before a release build
.PHONY: stage
stage:
	$(SED) -i "s/VERSION = '.*'/VERSION = '$(VERSION)'/" lib/BlockChypClient.php

# Publish packages
.PHONY: publish
publish:

# Checks all files for syntax errors
.PHONY: lint
lint:
	for path in lib examples tests; do \
		find "$$path" -name '*php' -print0 | xargs -n 1 -0 $(PHP) --syntax-check; \
	done
