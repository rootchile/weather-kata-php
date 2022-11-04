# Weather Kata

![](https://img.shields.io/badge/language-php-lightgrey)
![](https://img.shields.io/github/stars/mangasf/weather-kata-php)
![](https://img.shields.io/github/issues/mangasf/weather-kata-php)

The goals is to identify the code smells and fix it.

## Pre requisites
```text
PHP 8.1
```
    
## Install dependencies
```text
make install
```

## Check complexity
```text
make complexity
```
    
## Run the tests
```text
make tests
```

## Run using Docker
```bash
docker build -t php8 .
docker run --name php8 -ti --rm -v $PWD:/home php8 /bin/bash
```