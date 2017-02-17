<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * madePeopleWork

The work is the module to store a sum multiplied by a decimal number. The decimal number is entered from a web form, validation for the decimal is performed in both frontend and backend by javascript and PHP respectively.

frontend

Frontend eventHandling and data validation is done in raw Javascript, and form submission is done in ajax by jQuery. the switch button is used to enable and disable the display of form.

backend

It is handled by php, there is a db class to process database setting and table queries. The backend returns a success or error message to frontend.
 */
require 'Db.php';
if ($_POST && isset($_POST['decimal'])) {
    $decimal = $_POST['decimal'];
    if (checkDecimal($decimal)) {
        $db = new Db();
        $totalSum = rand(0, 99999999) * floatval($decimal);
        $totalSum = $db->processValue($totalSum);
        $result = $db->query("INSERT INTO `paied` (`paidvalues`) VALUES (" . $totalSum . ")");
        if ($result) {
            echo 'record is inserted successfully';
        } else {
            echo 'database error';
        }
    } else {
        echo 'wrong input or system error';
    }
}

function checkDecimal($num) {
    return is_numeric($num) && strpos($num, ".") !== false && substr($num, -1) !== '.';
}
