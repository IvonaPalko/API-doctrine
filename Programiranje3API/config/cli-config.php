<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
// vendor/bin/doctrine orm:schema-tool:update --force --dump-sql
require_once 'bootstrap.php';
$doctrineBoostrap = new DoctrineBoostrap();
return ConsoleRunner::createHelperSet($doctrineBoostrap->getEntityManager());