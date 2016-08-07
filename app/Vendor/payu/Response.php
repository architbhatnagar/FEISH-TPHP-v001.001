<?php

App::import('Vendor', 'payu/Misc');
App::import('Vendor', 'payu/Cookie');
App::import('Vendor', 'payu/Curl');
App::import('Vendor', 'payu/Response');

class Response {

    private $salt;
    private $params = array();

    public function __construct($salt) {
        $this->salt = $salt;
    }

    public function __destruct() {
        unset($this->salt);
        unset($this->params);
    }

    public function __set($key, $value) {
        $this->params[$key] = $value;
    }

    public function __get($key) {
        return $this->params[$key];
    }

    public function get_response($params = null) {
        $this->params = (is_array($params) && count($params)) ? $params : $_POST;

        $error = $this->check_params();

        if ($error === true) {
            if (Misc::reverse_hash($this->params, $this->salt, $this->params['status']) === $this->params['hash']) {
                switch ($this->params['status']) {
                    case 'success' :
                        return array(
                            'status' => Misc::SUCCESS,
                            'data' => $this->params['surl']);
                        break;
                    case 'failure' :
                        return array(
                            'status' => Misc::SUCCESS,
                            'data' => $this->params['furl']);
                        break;
                    default :
                        return array(
                            'status' => Misc::FAILURE,
                            'data' => 'Unmapped status');
                }
            } else {
                return array(
                    'status' => Misc::FAILURE,
                    'data' => 'Hash Mismatch');
            }
        } else {
            return array('status' => Misc::FAILURE, 'data' => $error);
        }
    }

    private function check_params() {
        if (empty($this->params['key']))
            return $this->error('key');
        if (empty($this->params['txnid']))
            return $this->error('txnid');
        if (empty($this->params['amount']))
            return $this->error('amount');
        if (empty($this->params['firstname']))
            return $this->error('firstname');
        if (empty($this->params['email']))
            return $this->error('email');
        if (empty($this->params['phone']))
            return $this->error('phone');
        if (empty($this->params['productinfo']))
            return $this->error('productinfo');
        if (empty($this->params['surl']))
            return $this->error('surl');
        if (empty($this->params['furl']))
            return $this->error('furl');

        return true;
    }

    private function error($key) {
        return 'Mandatory parameter ' . $key . ' is empty';
    }

}
