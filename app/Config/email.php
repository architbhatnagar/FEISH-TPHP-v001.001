<?php

/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * This is email configuration file.
 *
 * Use it to configure email transports of CakePHP.
 *
 * Email configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * transport => The name of a supported transport; valid options are as follows:
 *  Mail - Send using PHP mail function
 *  Smtp - Send using SMTP
 *  Debug - Do not send the email, just return the result
 *
 * You can add custom transports (or override existing transports) by adding the
 * appropriate file to app/Network/Email. Transports should be named 'YourTransport.php',
 * where 'Your' is the name of the transport.
 *        $email->SMTPDebug = 2; // Enables SMTP debug information - SHOULD NOT be active on production servers!
        $email->SMTPAuth = false; // Enables SMTP authentication.
 * from =>
 * The origin email. See CakeEmail::from() about the valid values
 *
 */
class EmailConfig {

    public $default = array(
        'transport' => 'Mail',
        'from' => 'you@localhost',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
    );
    public $smtp = array(
        'transport' => 'Smtp',
        'from' => array('site@localhost' => 'My Site'),
        'host' => 'localhost',
        'port' => 25,
        'timeout' => 30,
        'username' => 'root',
        'password' => '',
        'client' => null,
        'log' => false,
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
    );
    public $fast = array(
        'from' => 'you@localhost',
        'sender' => null,
        'to' => null,
        'cc' => null,
        'bcc' => null,
        'replyTo' => null,
        'readReceipt' => null,
        'returnPath' => null,
        'messageId' => true,
        'subject' => null,
        'message' => null,
        'headers' => null,
        'viewRender' => null,
        'template' => false,
        'layout' => false,
        'viewVars' => null,
        'attachments' => null,
        'emailFormat' => null,
        'transport' => 'Smtp',
        'host' => 'localhost',
        'port' => 25,
        'timeout' => 30,
        'username' => 'user',
        'password' => 'secret',
        'client' => null,
        'log' => true,
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
    );
//    privious settings
    /*public $renew_plan = array(
        'host' => 'smtp.sendgrid.net',
        'port' => 587,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'infob3ds',
        'password' => 'Code@123',
        'transport' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'renew_plan',
        'bcc' => array('siddiqui.azhar@gmail.com')
    ); */
    /////with new setting for goDaddy
    public $renew_plan = array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'renew_plan',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    
    public $verify_account = array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'verify_account',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $communication_mail = array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'communication_mail',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $forgot_password = array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'forgot_password',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $plan_purchased_mail = array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'plan_purchased_mail',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $new_registration=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'new_registration',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $contact_us=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'contact_us',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $book_appointment=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'book_appointment',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    
    public $book_appointment_status=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'book_appointment_status',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    
    public $patient_book_appointment=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'patient_book_appointment',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    
    public $patient_book_appointment_status=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'patient_book_appointment_status',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,

    );
    public $appointment_status_admin=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'appointment_status_admin',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $appointment_status_patient=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'appointment_status_patient',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $appointment_status_doctor=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'appointment_status_doctor',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $doctor_book_appointment=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'doctor_book_appointment',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $doctor_book_appointment_doctor=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'doctor_book_appointment_doctor',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $doctor_book_appointment_doctor_patient=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'doctor_book_appointment_doctor_patient',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $assistant_book_appointment_patient=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'assistant_book_appointment_patient',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $assistant_book_appointment_doctor=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'assistant_book_appointment_doctor',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $assistant_book_appointment_doctor_patient=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'assistant_book_appointment_doctor_patient',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $plan_purchased_mail_admin=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'plan_purchased_mail_admin',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $plan_purchased_mail_for_patient=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'plan_purchased_mail_for_patient',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $plan_purchased_mail_for_patient_to_doctor=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'plan_purchased_mail_for_patient_to_doctor',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $plan_purchased_mail_for_patient_to_admin=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'plan_purchased_mail_for_patient_to_admin',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $change_password_patient=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'change_password_patient',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $change_password_patient_admin=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'change_password_patient_admin',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );



    public $new_registration_newletter=array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'from' => array('support@feish.online' => 'Feish Team'),
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => '',
        'bcc' => array('siddiqui.azhar@gmail.com'),
        'log' => true,
        'tls' => true,
    );
    public $smtptest = array(
        'host' => 'sg2plcpnl0009.prod.sin2.secureserver.net',
        'port' => 465,
        'username' => 'feishlive',
        'password' => 'Code@123',
        'delivery' => 'Smtp',
        'emailFormat' => 'html',
        'template' => 'cron',
        'log' => true,
        'tls' => true,
    );
}
