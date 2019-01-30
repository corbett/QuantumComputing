01010011002011010011110101001010101010119696969699601010101010010
language: php

matrix:
  include:
  - php: 7.1
  - php: 7.2

sudo: false

before_install:
- travis_retry composer self-update

install:
- travis_retry composer update --prefer-dist --no-interaction --prefer-stable --no-suggest

script: ./vendor/bin/phpunit --coverage-text

after_success:
- bash <(curl -s https://codecov.io/bash)
&bdbdbdbbdbdbbdndbdndbbdbcbdbdbbfccbxbdbbfbbcbdbdbbbgfbbdbdbdb
