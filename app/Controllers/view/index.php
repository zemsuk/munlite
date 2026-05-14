<?php
include 'header.php';
foreach ($contents as $content) {
    echo $content['id'] . "-" . $content['title'] . "<br>";
}
include 'footer.php';
?>