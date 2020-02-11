<?php
/* Cron Job: * / 5 * * * * "Every 5 Minuites"
 * PHP.exe db2json.php
 * */

function format_date($date_sql) {
    return $date_sql;
}

$host = '127.0.0.1';
$db   = 'adelphi_marketing';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

/* Create _settings table (for storing backup information) */
$pdo->query("CREATE TABLE IF NOT EXISTS `_settings` (`SETTING_ID` varchar(20) PRIMARY KEY NOT NULL,`SETTING_VALUE` tinytext NOT NULL)");

$config = [
    /*Format: ["row as rowname","row"]*/
    "rows" => ["*"],
    "debug" => false,
    "only_new" => true
];

$last_backed_up = $pdo->query("select COALESCE(max(SETTING_VALUE + 0),-1) as last_backed_up FROM _settings WHERE SETTING_ID = 'assignments_last'");

$last_backed_up_no = $last_backed_up->fetch()["last_backed_up"];

$select_query = $pdo->prepare("SELECT " . implode(",", $config["rows"]) . " FROM Assignments WHERE assignment_nid > ?");
if ($config["only_new"]) {
    $select_query->execute([$last_backed_up_no]);
} else {
    $select_query->execute([-1]);
}

$formatted = [];
$max_row = $last_backed_up_no;

foreach ($select_query->fetchAll() as $item=>$value) {
    if (isset($value["StartDate"])) {
        $value["StartDate"] = format_date($value["StartDate"]);
    }
    if (isset($value["EndDate"])) {
        $value["EndDate"] = format_date($value["EndDate"]);
    }

    if ($value["assignment_nid"] > $max_row) {
        $max_row = $value["assignment_nid"];
    }
    unset($value["assignment_nid"]);
    print($max_row);
    $formatted[$item] = $value;
}

if ($config["only_new"]) {
    /* Insert Data */
    echo(json_encode($formatted));
} else {
    /* Wipe Table In Firebase */

    /* Insert Data*/
    echo(json_encode($formatted));
}

$update_done = $pdo->prepare("INSERT INTO _settings (SETTING_ID, SETTING_VALUE) VALUES ('assignments_last',?) ON DUPLICATE KEY UPDATE `SETTING_VALUE` = ?;");
$update_done->execute([$max_row, $max_row]);
