### Hexlet tests and linter status:
[![Actions Status](https://github.com/KonstKazan/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/KonstKazan/php-project-48/actions)

[![Maintainability](https://api.codeclimate.com/v1/badges/50337f120b64478dc4a0/maintainability)](https://codeclimate.com/github/KonstKazan/php-project-48/maintainability)

[![Test Coverage](https://api.codeclimate.com/v1/badges/50337f120b64478dc4a0/test_coverage)](https://codeclimate.com/github/KonstKazan/php-project-48/test_coverage)

[![Actions Status](https://github.com/KonstKazan/php-project-48/actions/workflows/workflow.yml/badge.svg)](https://github.com/KonstKazan/php-project-48/actions)


#### An application for finding differences in JSON and YAML files


## Setup
```sh
$ git clone https://github.com/KonstKazan/php-project-48.git
$ cd php-project-48
$ make install
```
```sh
Generate diff
 
Usage:
    gendiff (-h|--help)
    gendiff (-v|--version)
    gendiff [--format <fmt>] <firstFile> <secondFile>
 
Options:
    -h --help                     Show this screen
    -v --version                  Show version
    --format <fmt>                Report format [default: stylish]
    