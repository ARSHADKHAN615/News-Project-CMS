<?php
require "config.php";
session_start();
session_unset();
session_destroy();
header("location:{$hostName}/admin/index");
