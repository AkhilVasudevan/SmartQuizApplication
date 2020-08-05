<?php
session_start();
if(!isset($_SESSION['user']))
{
    echo "n";
}
else
{
    session_destroy();
    echo "s";
}
?>