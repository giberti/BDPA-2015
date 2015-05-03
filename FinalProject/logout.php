<?php

require 'includes/session.php';
logoutUser();

header('Location: index.php');