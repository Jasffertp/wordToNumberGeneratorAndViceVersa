<?php

require_once 'controllers/controller.php';

$controller = new Controller();

// * If the user has clicked the submit button
if(isset($_POST['input1']) && isset($_GET['action'])){
    $action = $_GET['action'];
    // echo $_POST['input1'].' '.$_GET['action'];
    $controller->$action($_POST['input1']);
}elseif (isset($_GET['action']) && $_GET['action'] === 'change'){
    // * Reverse the function 

    if($_GET['function'] === 'wordToNumber'){
        $controller->numberToWord();
    }else{
        $controller->wordToNumber();
    }
}else{
    // * Default view of index
    $controller->index();
}

// $controller->checkValidWord('OneHundred thousand and fiftytwo');
// echo preg_replace('/[^A-Za-z0-9]/', '', 'one,hund-red, thousa$nd fi-.,/fty two');


// echo isset($_POST['input1']);
// echo $action;
// $controller->$action();
// $controller->wordToNumber('One Hundred Thousand Seven hundred fifty');
// $controller->wordToNumber();
// $controller->numberToWord();
// $controller->wordToNumber('five hundred sixty four million eight Hundred fifty seven Thousand Seven hundred fifty');
// $controller->wordToNumber('sixty four thousand seven hundred fifty three');
// $controller->wordToNumber('one hundred');
// $controller->PHPToUSDConverter(50);
