<?php


require_once "pastouche/env.php";
require_once 'exceptions.php';




function getDb() {
	
// Connexion � la base de donn�es
    static $db = null;
    if ($db == null) {
        $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PWD);
        // Configuration facultative de la connexion
        $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caract�res minuscules
        $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // les erreurs lanceront des exceptions
    }
    return $db;
}

function arrToKeysAndMarks($array) {
    $vals = array();
    $marks = array();
    $cles = array_keys($array);
    foreach ($cles as $cle) {
        $vals[] = $array[$cle];
        $marks[] = '?';
    }
    return array($cles, $vals, $marks);
}

function exec_uniq($stmt,$vals) {
    try {
    $stmt->execute($vals);
    
    }
    catch (PDOException $e) {
	if ($e->errorInfo[1] == 1062) {
	    throw new DbInsertUniqueExc();
	}
	else {
	    throw $e;
	}	
    }
    return getDb()->lastInsertId();
}

function insertDb($table, $array){
    $db = getDb();
    list($cles, $vals,$marks) = arrToKeysAndMarks($array);

    $str_marks = join(',', $marks);
    $str_keys = join(',', $cles);

    $stmt = $db->prepare("INSERT INTO ".$table."(".$str_keys.') VALUES ('.$str_marks.')');

    return exec_uniq($stmt, $vals);
}

function updateDb($table, $valeurs, $id) {
    $db = getDb();

    list($cles,$vals,$marks) = arrToKeysAndMarks($valeurs);

    $lst_str = array_map(function($key) { return $key.'=?';}, $cles);
    $str = join($lst_str, ',');

    $stmt = $db->prepare("UPDATE ".$table." SET ".$str. ' WHERE ID=?');
    $vals[] = $id;

    return exec_uniq($stmt, $vals);
}

function selectDbWhStr($table, $cols, $wherestr, $vals) {
    $db = getDb();


    $cols_str = join($cols,',');

    $stmt= $db->prepare('SELECT '.$cols_str.' FROM '.$table.' WHERE '.$wherestr);
    if ($stmt->execute($vals))
	return $stmt;
    else
	return false;
}

function selectDbArr($table, $cols, $wherea) {
    $db = getDb();

    list($cles,$vals,$marks) = arrToKeysAndMarks($wherea);

    $lst = array_map(function($key) { return $key.'=?';}, $cles);
    $lst_str = join($lst, ' AND ');
    return selectDbWhStr($table,$cols, $lst_str, $vals);
}

function selectId($table, $cols, $id) {
    return selectDbWhStr($table, $cols, 'ID=?', array($id));
}

function deleteDbWhStr($table, $wherestr, $vals) {
    $db = getDb();

    $stmt= $db->prepare('DELETE FROM '.$table.' WHERE '.$wherestr);
    return $stmt->execute($vals);
}

function deleteDbArr($table, $wherea) {
    list($cles,$vals,$marks) = arrToKeysAndMarks($wherea);

    $lst = array_map(function($key) { return $key.'=?';}, $cles);
    $lst_str = join($lst, ' AND ');
    return deleteDbWhStr($table,$cols, $lst_str, $vals);
}
