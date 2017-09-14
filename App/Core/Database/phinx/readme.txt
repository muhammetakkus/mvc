composer require robmorgan/phinx
vendor/bin/phinx init
php vendor/robmorgan/phinx/bin/phinx init

php vendor/robmorgan/phinx/bin/phinx create TestTable
php vendor/robmorgan/phinx/bin/phinx migrate

//phinx her oluþturulan tabloya auto_increment bir id kolonu otomatik olarak ekliyor. eðer id kolonu oluþturmaya çalýþýrsan dublicate hatasý verir