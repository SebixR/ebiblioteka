<?php

session_start(); //we want to start a session to destroy it
session_unset();
session_destroy();

header("Location: ../index.php?login=success");