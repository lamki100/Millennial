<?php

include "../inc/db.php";

setCookie("token", "", time()-1000, "/");
header("Location: /");
