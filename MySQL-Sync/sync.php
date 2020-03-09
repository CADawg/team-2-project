<?php
/* Cron Job: * / 5 * * * * "Every 5 Minuites"
 * PHP.exe db2json.php
 * */
require "vendor/autoload.php";

const DEFAULT_URL = 'https://digitalebeanings.firebaseio.com/';
const DEFAULT_TOKEN = '2TzjTYt9oAgloXbOEkxzKNDYfiz98kP6kn1is0KH';
const DEFAULT_TODO_PATH = 'digitalebeanings/ebeanos';
const DELETE_PATH = '/sample';
use MrShan0\PHPFirestore;
use MrShan0\PHPFirestore\FirestoreClient;
use MrShan0\PHPFirestore\FirestoreDatabaseResource;
use MrShan0\PHPFirestore\FirestoreDocument;

function format_date($date_sql) {
    $date_to_epoch = strtotime($date_sql);
    return strftime("%d/%m/%C", $date_to_epoch);
}

$host = '127.0.0.1';
$db   = '';
$user = '';
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
    "debug" => false
];

$last_backed_up = $pdo->query("select COALESCE(max(SETTING_VALUE + 0),-1) as last_backed_up FROM _settings WHERE SETTING_ID = 'assignments_last'");
$last_backed_up_evaluations = $pdo->query("select COALESCE(max(SETTING_VALUE + 0),-1) as last_backed_up FROM _settings WHERE SETTING_ID = 'evaluations_last'");
$last_backed_up_targets = $pdo->query("select COALESCE(max(SETTING_VALUE + 0),-1) as last_backed_up FROM _settings WHERE SETTING_ID = 'targets_last'");

$last_backed_up_no = $last_backed_up->fetch()["last_backed_up"];
$last_backed_up_no_evaluations = $last_backed_up_evaluations->fetch()["last_backed_up"];
$last_backed_up_no_targets = $last_backed_up_targets->fetch()["last_backed_up"];

$select_query = $pdo->prepare("SELECT " . implode(",", $config["rows"]) . " FROM Assignments WHERE assignment_nid > ?");
$select_query->execute([$last_backed_up_no]);

$select_query_evaluations = $pdo->prepare("SELECT " . implode(",", $config["rows"]) . " FROM employee_evaluations WHERE assignment_nid > ?");
$select_query_evaluations->execute([$last_backed_up_no_evaluations]);

$select_query_targets = $pdo->prepare("SELECT " . implode(",", $config["rows"]) . " FROM targets WHERE assignment_nid > ?");
$select_query_targets->execute([$last_backed_up_no_targets]);

$formatted = [];
$max_row = $last_backed_up_no;

$formatted_evaluations = [];
$max_row_evaluations = $last_backed_up_no;

$formatted_targets = [];
$max_row_targets = $last_backed_up_no;

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

foreach ($select_query_evaluations->fetchAll() as $item=>$value) {
    if (isset($value["StartDate"])) {
        $value["StartDate"] = format_date($value["StartDate"]);
    }
    if (isset($value["EndDate"])) {
        $value["EndDate"] = format_date($value["EndDate"]);
    }

    if ($value["assignment_nid"] > $max_row) {
        $max_row_evaluations = $value["assignment_nid"];
    }
    unset($value["assignment_nid"]);
    print($max_row_evaluations);
    $formatted_evaluations[$item] = $value;
}

foreach ($select_query_targets->fetchAll() as $item=>$value) {
    if (isset($value["StartDate"])) {
        $value["StartDate"] = format_date($value["StartDate"]);
    }
    if (isset($value["EndDate"])) {
        $value["EndDate"] = format_date($value["EndDate"]);
    }

    if ($value["assignment_nid"] > $max_row) {
        $max_row_targets = $value["assignment_nid"];
    }
    unset($value["assignment_nid"]);
    print($max_row_targets);
    $formatted_targets[$item] = $value;
}

/* Insert Data */
foreach ($formatted as $fbrow) {
    $firestoreClient = new PHPFirestore\FirestoreClient('dsp-database', 'AIzaSyB_ClCbkCc65_hASqUzQSy2pO1vBk9cZHY', [
        'database' => 'Absences',
    ]);

    $firestoreClient->addDocument("Absences", $fbrow);
}

/* Insert Data */
foreach ($formatted_evaluations as $fbrow) {
    $firestoreClient = new PHPFirestore\FirestoreClient('dsp-database', 'AIzaSyB_ClCbkCc65_hASqUzQSy2pO1vBk9cZHY', [
        'database' => 'employeeEvaluations',
    ]);

    $firestoreClient->addDocument("employeeEvaluations", $fbrow);
}

/* Insert Data */
foreach ($formatted_targets as $fbrow) {
    $firestoreClient = new PHPFirestore\FirestoreClient('dsp-database', 'AIzaSyB_ClCbkCc65_hASqUzQSy2pO1vBk9cZHY', [
        'database' => 'targets',
    ]);

    $firestoreClient->addDocument("targets", $fbrow);
}

$update_done = $pdo->prepare("INSERT INTO _settings (SETTING_ID, SETTING_VALUE) VALUES ('assignments_last',?) ON DUPLICATE KEY UPDATE `SETTING_VALUE` = ?;");
$update_done->execute([$max_row, $max_row]);

$update_done_evaluations = $pdo->prepare("INSERT INTO _settings (SETTING_ID, SETTING_VALUE) VALUES ('evaluations_last',?) ON DUPLICATE KEY UPDATE `SETTING_VALUE` = ?;");
$update_done_evaluations->execute([$max_row, $max_row]);

$update_done_targets = $pdo->prepare("INSERT INTO _settings (SETTING_ID, SETTING_VALUE) VALUES ('targets_last',?) ON DUPLICATE KEY UPDATE `SETTING_VALUE` = ?;");
$update_done_targets->execute([$max_row, $max_row]);
