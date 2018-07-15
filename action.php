<?php

//----------------- user data ----------------/
$data = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'message' => $_POST['message'],
];

//----------------- user cv file ----------------/
$userFileName =  date('jS F h:i:s A'). "_" . $_FILES['file']['name'];
$userFileType = $_FILES['file']['type']; // can be "application/msword" , "application/pdf"

// checking file type
if($userFileType === "application/msword" || $userFileType === "application/pdf"){
    //------ cv file saving --------/
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/user-cv/';
    $uploadedFile = $uploadDir . basename($userFileName);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadedFile);

    //------- data recording -------/
    $openFile = fopen('source/'. $data['name'] .'_data.txt','w');
    $write = fwrite($openFile, 'User: ' . $data['name'] . '. User email: ' . $data['email'] . '. User message: ' . $data['message']);
    fclose($openFile);

    echo 'ok';
} else {
    echo 'error';;
}
