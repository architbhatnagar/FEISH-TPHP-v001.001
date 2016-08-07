<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Appointments Controller
 *
 * @property Appointment $Appointment
 * @property PaginatorComponent $Paginator
 */
class CronesController extends AppController {

    public function todays_schedule_mail() {
        
    }

    public function plan_expiration_mails() {
        $this->layout = null;

        $this->loadModel('DoctorPlanDetail');
        $doctors = $this->DoctorPlanDetail->find('all', array(
            'conditions' => array(
                'DoctorPlanDetail.end_date between ? and ?' => array(date('Y-m-d'), date('Y-m-d', strtotime('+7 days'))),
            ), 'fields' => array(
                'DoctorPlanDetail.name',
                'DoctorPlanDetail.end_date',
                'DoctorPlanDetail.doctor_package_id',
                'User.salutation',
                'User.first_name',
                'User.last_name',
                'User.email',
                'User.mobile'
            )
        ));
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        
        foreach ($doctors as $fetch_data) {
            $user_data = array();
            $user_data['salutation'] = $fetch_data['User']['salutation'];
            $user_data['first_name'] = $fetch_data['User']['first_name'];
            $user_data['last_name'] = $fetch_data['User']['last_name'];
            $user_data['plan_name'] = $fetch_data['DoctorPlanDetail']['name'];
            $user_data['end_date'] = $fetch_data['DoctorPlanDetail']['end_date'];
            $email = new CakeEmail();
            $email->config('renew_plan');
            $email->to($fetch_data['User']['email']);
            $email->viewVars(compact('user_data', 'salutations'));
            $email->subject('Your plan is expiring.....');
            $email->send();


            /* sms text for doctor */
            $number = $fetch_data['User']['mobile'];
            $message = "Dear" .$user_data['salutation'].". ".$user_data['first_name']." ".$user_data['last_name']. ",the plan ".$user_data['plan_name'] . " is about to expire on" . $fetch_data['DoctorPlanDetail']['end_date'] . " : Please recharge your plan on or before".$user_data['end_date']."to continue using the services.";
            $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);
            /* end */
        }



        $this->loadModel('PatientPackageLog');
        $patients = $this->PatientPackageLog->find('all', array(
            'conditions' => array(
                'PatientPackageLog.end_date between ? and ?' => array(date('Y-m-d'), date('Y-m-d', strtotime('+7 days'))),
            ), 'fields' => array(
                'PatientPackageLog.package_name',
                'PatientPackageLog.end_date',
                'PatientPackageLog.patient_package_id',
                'User.salutation',
                'User.first_name',
                'User.last_name',
                'User.email',
                'User.mobile'
            )
        ));

         
        foreach ($patients as $fetch_data) {
            $user_data = array();
            $user_data['salutation'] = $fetch_data['User']['salutation'];
            $user_data['first_name'] = $fetch_data['User']['first_name'];
            $user_data['last_name'] = $fetch_data['User']['last_name'];
            $user_data['plan_name'] = $fetch_data['PatientPackageLog']['package_name'];
            $user_data['end_date'] = $fetch_data['PatientPackageLog']['end_date'];
            $email = new CakeEmail();
            $email->config('renew_plan');
            $email->to($fetch_data['User']['email']);
            $email->viewVars(compact('user_data', 'salutations'));
            $email->subject('Your plan is expiring.....');
            $email->send();
            
            /* sms text for doctor */
            $number = $fetch_data['User']['mobile'];

            $message = "Dear " .$user_data['salutation'].". ".$user_data['first_name']." ".$user_data['last_name']. ",the plan" . $user_data['plan_name'] . " is about to expire on" . $fetch_data['PatientPackageLog']['end_date'] . ". Please recharge your plan on or before ".$fetch_data['PatientPackageLog']['end_date']." to continue using the services.";
            $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);
            /* end */
        }
        echo "done";
        die;
    }

    public function todays_appointments_alert() {
        
    }

    public function beforeFilter() {
        $this->Auth->allow(array('todays_schedule_mail', 'plan_expiration_mails', 'todays_appointments_alert'));
    }

}
