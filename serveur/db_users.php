<?php
require_once "pastouche/env.php";
if (ENV == "SERVER")
	require_once "db_users_server.php";
else
	require_once "db_users_local.php";