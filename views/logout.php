<?php

include_once "../config/core.php";
include_once "../models/user.php";

(new User())->logout();

header("Location: {$home_url}/views/login.php");