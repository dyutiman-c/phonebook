<?php
define('BASEPATH', __DIR__ . '/ciapp');
define('ENVIRONMENT', 'development');

if(file_exists(__DIR__ . '/ciapp/application/config/development/database.php')) {
    include __DIR__ . '/ciapp/application/config/development/database.php';
} else {
    include __DIR__ . '/ciapp/application/config/database.php';
}

$dsn = $db[$active_group];

return array(
    "paths" => array(
        "migrations" => __DIR__ ."/dbschema/migrations",
        "seeds" => __DIR__ ."/dbschema/seeds"
    ),
    "environments" => array(
        "default_migration_table" => "phinxlog",
        "default_database" => "development",
        "development" => array(
            "adapter" => "mysql",
            "host" => $dsn['hostname'],
            "name" => $dsn['database'],
            "user" => $dsn['username'],
            "pass" => $dsn['password'],
            "port" => 3306
        )
    )
);