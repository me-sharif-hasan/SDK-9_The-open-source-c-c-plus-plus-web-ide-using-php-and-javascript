<?php
session_start();
echo !empty($_SESSION['last_run'])?$_SESSION['last_run']:json_encode(array('status'=>false));