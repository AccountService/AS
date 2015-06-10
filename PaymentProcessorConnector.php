<?php
    class PaymentProcessorConnector {
        public function setKeys($keys) {
            $keys_json = json_encode($keys);
            pushKeys($keys_json);
        }

        public function pushKeys($keys_json) {
            $_POST['keys'] = $keys_json;
        }
    }