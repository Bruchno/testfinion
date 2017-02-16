<?php
if(isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )){
    $extensions = array('jpeg', 'jpg', 'png', 'gif');
    $path = 'i/';
    $response = '';
    for($i = 0; $i < count($_FILES['image']['name']); $i++){
        $ext = strtolower(pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION));
        if (in_array($ext, $extensions)){
            $path = $path . uniqid() . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $path)){
                $response .= $path;
            }
        }   else {
            $response .= 'File ' . $_FILES['image']['name'][$i] . ' must be an image!';
        }
    }
    exit($response);
}
?>