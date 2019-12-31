# Version config
TAG := $(shell git tag --points-at HEAD | sort --version-sort | tail -n 1)
LASTTAG := $(or $(shell git tag -l | sort -r -V | head -n 1),0.1.0)
SNAPINFO := $(shell date +%Y%m%d%H%M%S)git$(shell git log -1 --pretty=%h)
RELEASE := $(or $(BUILD_NUMBER), 1)
VERSION := $(or $(TAG:v%=%),$(LASTTAG:v%=%))-$(or $(BUILD_NUMBER), 1)$(if $(TAG),,.$(SNAPINFO))

# Executables
PHP = php
PHPUNIT = ./vendor/bin/phpunit

# Default target
.PHONY: all
all: clean build test

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
	$(PHPUNIT) --bootstrap vendor/autoload.php --group itest tests

# Performs any tasks necessary before a release build
.PHONY: stage
stage:

# Publish packages
.PHONY: publish
publish:

# Checks all files for syntax errors
.PHONY: lint
lint:
	for path in lib examples tests; do \
		find "$$path" -name '*php' -print0 | xargs -n 1 -0 $(PHP) --syntax-check; \
	done
