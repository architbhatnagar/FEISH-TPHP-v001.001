<?php
App::import('Vendor', 'payu/Payment');
App::import('Vendor', 'payu/Cookie');
App::import('Vendor', 'payu/Curl');
App::import('Vendor', 'payu/Response');
App::import('Vendor', 'payu/Misc');

class Payu {

    /**
     * Returns the pay page url or the merchant js file.
     * 
     * @param unknown $params        	
     * @param unknown $salt        	
     * @throws Exception
     * @return Ambigous <multitype:number string , multitype:number Ambigous <boolean, string> >
     */
    function pay($params, $salt) {
        if (!is_array($params))
            throw new Exception('Pay params is empty');

        if (empty($salt))
            throw new Exception('Salt is empty');

        $payment = new Payment($salt);
        $result = $payment->pay($params);
        unset($payment);

        return $result;
    }

    /**
     * Displays the pay page.
     * 
     * @param unknown $params        	
     * @param unknown $salt        	
     * @throws Exception
     */
    function pay_page($params, $salt) {
        if (count($_POST) && isset($_POST['mihpayid']) && !empty($_POST['mihpayid'])) {
            $_POST['surl'] = $params['surl'];
            $_POST['furl'] = $params['furl'];
            $result = $this->response($_POST, $salt);
            //debug($_POST);
            //debug($result);
            Misc::show_reponse($result);
        } else {
            $host = (isset($_SERVER['https']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

            if (isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']))
                $params['surl'] = $host;
            if (isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']))
                $params['furl'] = $host;

            $result = $this->pay($params, $salt);
            Misc::show_page($result);
        }
    }

    /**
     * Returns the response object.
     * 
     * @param unknown $params        	
     * @param unknown $salt        	
     * @throws Exception
     * @return number
     */
    function response($params, $salt) {
        if (!is_array($params))
            throw new Exception('PayU response params is empty');

        if (empty($salt))
            throw new Exception('Salt is empty');

        if (empty($params['status']))
            throw new Exception('Status is empty');

        $response = new Response($salt);
        $result = $response->get_response($_POST);
        unset($response);

        return $result;
    }

}
