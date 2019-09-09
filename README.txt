Steps to install and use the project

$ git clone git@github.com:ovanesb/fee_calc.git

If there is no vendor folder please run the following.
$ composer install

In order to run the script please run the following when in project root folder:
$ php Script.php input.csv


To run PHPUnit 8 test please to the following:

$ ./vendor/bin/phpunit --bootstrap vendor/autoload.php app/Tests/CommissionFeesTest

$ ./vendor/bin/phpunit --bootstrap vendor/autoload.php app/Tests/ValidationTest

