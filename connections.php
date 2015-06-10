<?php

    function setKeys($keys) {
        $keys_json = json_encode($keys);
        $_POST['keys'] = $keys_json;
    }

    function setRegInfo($reg_info) {
        $reg_json = json_encode($reg_info);
        $_POST['reginfo'] = $reg_json;
    }