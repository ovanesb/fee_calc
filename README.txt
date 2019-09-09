
<pre>
    $ mkdir fee_calc
    $ cd fee_calc
    $ git clone git@github.com:ovanesb/fee_calc.git

If there is no vendor folder please run the following.
<pre>
    composer install
</pre>

To run PHPUnit 8 test please to the following:
<pre>
    ./vendor/bin/phpunit --bootstrap vendor/autoload.php app/Tests/CommissionFeesTest

    ./vendor/bin/phpunit --bootstrap vendor/autoload.php app/Tests/ValidationTest
</pre>
