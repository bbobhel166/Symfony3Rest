symfony
=======

A Symfony project created on January 23, 2017, 9:28 pm.

To INSTALL projectsmanager : 

- composer install
- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:diff
- php bin/console doctrine:migrations:migrate

TO INSTALL test environement
- php bin/console  doctrine:database:create --env=test
- php bin/console  doctrine:schema:create --env=test
- php bin/console doctrine:schema:update --env=test --force
- update <env name="TEST_BASE_URL" value="http://XXXXXX.local" />


Load FIXTURE (do not do this on PROD !!!) :
- php bin/console doctrine:fixtures:load


To TEST projet (phpunit) : 
- php vendor/phpunit/phpunit/phpunit -c app/ (test tout)
- php vendor/phpunit/phpunit/phpunit -c app/ --filter testPOST src/Wunderman/EpreventionBundle/Tests/Controller/Api/MetierControllerTest.php (test uniquement une fonction)




To generate an ENTITY
php bin/console generate:doctrine:entity




src/Wunderman/EpreventionBundle/Tests/Controller/Api/MetierControllerTest.php


