<?php
require(realpath(__DIR__)."/../config/Session.php");
require(realpath(__DIR__)."/../config/Bootstrap.php");

$s = new Session();
$s->logout();