composer require robmorgan/phinx
vendor/bin/phinx init
php vendor/robmorgan/phinx/bin/phinx init

php vendor/robmorgan/phinx/bin/phinx create TestTable
php vendor/robmorgan/phinx/bin/phinx migrate

//phinx her olu�turulan tabloya auto_increment bir id kolonu otomatik olarak ekliyor. e�er id kolonu olu�turmaya �al���rsan dublicate hatas� verir