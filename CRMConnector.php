<?php
class CRMConnector {
    public function setRegInfo($reg_info) {
        $keys_json = json_encode($reg_info);
        pushRegInfo($reg_info);
    }

    public function pushRegInfo($reg_info) {
        $_POST['reginfo'] = $reg_info;
    }
}