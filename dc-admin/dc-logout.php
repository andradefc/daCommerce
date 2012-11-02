<?php

session_destroy();

unset($user);

header('Location: dc-login');