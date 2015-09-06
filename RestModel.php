<?php

class RestModel {

    protected $msg;
    protected $link;
    protected $hour;
    protected $day;
    protected $year;
    protected $month;
    protected $doctor;
    protected $user;
    protected $spec;
    protected $specId;
    protected $location;
    protected $userId;
    protected $password;
    protected $regInfo;
    protected $lName;
    protected $fName;
    protected $loginInfo;

    public function __construct($data) {
        
        $this->link = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        
        if($data['specId']){
            $this->specId = $data['specId'];
        }
        
        if ($data['password']) {
            $this->password = $data['password'];
        }

        if ($data['email']) {
            $this->user = $data['email'];
        }
        
        if($data['loginInfo']){
            $this->loginInfo = $data['loginInfo'];
        }
        
        if($data['userId']){
            $this->userId = $data['userId'];
        }
        
        if (count($data) > 4 && isset($data['month'])) {
            $this->setDataForAppointment($data);
        }
        
        if(count($data) > 4 && isset($data['fName'])){
            
            $this->setDataForRegistration($data);
            
        }
    }
    
    public function setDataForAppointment($data){
        
            $this->hour = $data['hour'];
            $this->month = $data['month'];
            $this->year = $data['year'];
            $this->day = $data['day'];
            $this->doctor = trim($data['doctor']);
            $this->spec = $data['spec'];
            $this->location = $data['address'];
            $this->userId = $data['userId'];
            $statement = "Select * FROM users WHERE id = '$this->userId'";
            $stmt = $this->link->query($statement);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->user = $result[0]['email'];
        
    }
    
    public function setDataForRegistration($data){
        
        $this->user = $data['email'];
        $this->fName = $data['fName'];
        $this->lName = $data['lName'];
        $this->password = $data['password'];
        if($data['specId']){
            $this->specId = $data['specId'];
        }
        
    }

    public function getClient() {

        $client_email = '319250874787-uol4a4pfao97qmdn4orrb4ssdmdot21q@developer.gserviceaccount.com';
        $private_key = "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDIR5UzEVNKq+/y\nGWsw1xVm861mr2w+mMNl/uhwL+iiMTJWgj8HKqFzy2aAIPFDnZuLkilBx5L9qLRh\n0C673ZLmKT2q8c3VD5jyzaEIbJOyS3QynWDK1S39H8I1NMrhSzMhmIoQ22yAGYWw\n1vuwvselMpwWBU9h5H5KRdYuxuPTnpEuFgBAkQ8TXsf0ouflKSufJtx7a/5y6cjw\n82/dVcXmi0ns15RWBIDQ64c24ojTQgQq058fI7cliDaZ5+y4XXCFtBWces6fcKxo\nePo6wctTQFJnSSen5IoTV0E7nEAIdmFetEoPBS6hz/77BrcRuRJG2edVcPQL6Vtl\ntTei+qWLAgMBAAECggEAeTyb3KYIPZOHVI5+jLomgoPP2/ElHV9sKTn9iqv1rvkI\n98UwUi5EPcxK6BUI911Y40w/HUqqeFK/ntZe8+pVGm6sneZyKx+d/pzrdiYD4lI6\nrMkH5sDVbfzjm0Gx7l+PPC8SpNGvBHxuqXX6NivGvwG76ricLS4cJOnRlc9f6qFn\nGorWf2piFX7NneziI7Yc08nHijcNZie4otDXUhe5Y+iEGCvnFzldk6N+tCPerijR\n0Hdu7MNN7CWXoA0O4AqJsuwIDRu1sB7N11JzuNMKf0DCU/6ToIAoKC/g6XIT8NYx\nHQwirQk5eoM9tD5OQVMpYlPwMHKh4z+Mo73/bRIaAQKBgQD3Xf3Clzdaw6ShsnbM\nGh9I+F9TE8h5zqDaP7YzfSgwTI+trUBZuqa8Mgg9+hqNSwvu/7eEBhEbrXDqIZBq\n4+BMRvUzY6sPs/05OPyGts3V9hheuIuAbIyUChqCUIZl6Bjf6MUSVYeIAlMcOVA6\nsFTr7vfh+eqIBssft6xvK8gs4QKBgQDPROfc9N6f68dYTXYwBo8Eten/5/u+rzIs\nn7q35C9eZIpZSd0htEwiLnICaaAPPTSwZDJ2cbIN6+k589ifvRgnuGKCqOm+8lbq\nWByeZK1eMi84dz1sYx7pv101setHmcT/c8i1Xj9Mq8ucI6sCZZ18XSpupAmiIoi7\nlMYDgLzT6wKBgQDwUfpU8IAwx93L0gwkIkS+qb5CgffEjwAqyLcEstU2h0sXGjho\ndDPEpn7nZ3IgTwaa/QiXVSWN1CTc8hrSHe0tbcqOUIhCS0T6MOj1H+g9tEbcz0GI\nVO0GbgJvFDheDO0Nq6C6PSnc8xU3WF8fhWwbgyCEBD7cRG1WtSTrJIfnQQKBgQCe\nfSES+wc0n/T5l5nVFV7NClFZBkmgwJSMPMNpFAoIkrabmfiGajiBNqSlJaFnpbSh\nYKyZl0zAinD3iHdPhidvT/W71W+PO/2sCh4wG+nZimRDOCJ2u8CKmnKquVaglHtn\nnmCOFvguJ3t09G0yUwM+cnscyUA4g1GsphFX4lwBawKBgAdpjDtj2sdpX4qeAiJl\nMsUqkUepAN2L+GXQZSoOdFo7w2TLKT1fJG3Mav6f20XDENpcQUFBI1h2xBNMDfez\nV4V16Il8v2EPb5YtAcML4VHwi3W2GtZH5hL/NbwPV/1CALdDgd20jIkG6mtTTcSq\n2cklk6Mgoux2PcKfcu20bXJH\n-----END PRIVATE KEY-----\n";
        $scopes = array('https://www.googleapis.com/auth/calendar');
        $credentials = new Google_Auth_AssertionCredentials(
                $client_email, $scopes, $private_key
        );

        $client = new Google_client();
        $client->setAssertionCredentials($credentials);
        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion();
        }

        return $client;
    }

    public function appointment() {


        if ($this->checkDB() !== false) {
            $this->msg = array("msg" => "Избраният от вас час е вече зает.Моля изберете нов час или различен доктор!",
                "status" => 'notOk',
                "redirectPage" => "appointments.php");
        } else {
            $this->insertInDB();

            $this->insertInCalendar();
            $this->msg = array("msg" => "Часът е успешно запазен.", "redirectPage" => "appointments.php", "status" => "ok");
        }
        
        return json_encode($this->msg);
    }

    public function setTime() {

        $this->time = $this->day . "/" . $this->month . "/" . $this->year .
                "-" . $this->hour;
    }

    public function checkDB() {

        $this->setTime();
        $statement = "Select * FROM appointments WHERE doctor = '$this->doctor' and time = '$this->time'";
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function insertInDB() {

        $statement = "INSERT INTO appointments(doctor,time,userId)"
                . " VALUES('" . $this->doctor . "', '" . $this->time . "',$this->userId)";
        $this->link->exec($statement);
    }

    public function insertInCalendar() {

        $client = $this->getClient();

        $service = new Google_Service_Calendar($client);

        $dateTime = $this->year . "-" . $this->month . "-" . $this->day . "T" . $this->hour;
        try {
            $event = new Google_Service_Calendar_Event(array(
                'summary' => 'Appointment for exam',
                'location' => $this->location,
                'description' => 'Appointment with ' . $this->doctor . 'for exam',
                'start' => array(
                    'dateTime' => "$dateTime:00+03:00",
                    'timeZone' => 'Europe/Sofia',
                ),
                'end' => array(
                    'dateTime' => "$dateTime:45+03:00",
                    'timeZone' => 'Europe/Sofia',
                ),
                'recurrence' => array(
                    'RRULE:FREQ=DAILY;COUNT=1'
                ),
                'attendees' => array(
                    array('email' => $this->user),
                    array('email' => $this->doctor),
                ),
                'reminders' => array(
                    'useDefault' => FALSE,
                    'overrides' => array(
                        array('method' => 'email', 'minutes' => 24 * 60),
                        array('method' => 'sms', 'minutes' => 10),
                    ),
                ),
            ));


            $calendarId = 'primary';
            $event = $service->events->insert($calendarId, $event);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function checkAppointment() {
        
        $statement = "Select * FROM appointments WHERE userId = '$this->userId'";
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
        if (count($result) == 0) {
            $this->msg = array("Message" => "Няма намери часове.");
            return json_encode($this->msg);
        }
        
        
        return json_encode($result);
    }

    public function login() {

        $statement = "Select * FROM users WHERE email = '$this->user' and password = '$this->password'";
        
        if($this->loginInfo == "Доктор"){
            $statement = "Select * FROM doctors WHERE email = '$this->user' and password = '$this->password'";
        }
        
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            $this->userId = $result[0]['id'];

            $response = ['user' => $this->user, 'userId' => $this->userId, 'redirectPage' => 'home.php'];
            return json_encode($response);
        }
    }

    public function getAllSpecs() {

        $statement = "Select * FROM specs";
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }
    
    public function Registration(){
        
        $val = $this->regInfo;
        
        $statement = "INSERT INTO users(fName,lName,email,password) "
                . "VALUES('" . $this->fName . "',"
                . "'" . $this->lName . "',"
                . "'" . $this->user . "',"
                . "'" . $this->password . "')";
        
        if($this->specId){
        $statement = "INSERT INTO doctors(fName,lName,specId,email,password) "
                . "VALUES('" . $this->fName . "',"
                . "'" . $this->lName . "',"
                . "'" . $this->specId . "',"
                . "'" . $this->user . "',"
                . "'" . $this->password . "')";
        }
        
        $this->link->query($statement);
        
        $response = ['msg' => 'Регистрацията е успешна!Може да влезнете в системата.'];
       
        return json_encode($response);
        
    }
    
    public function selectDoctorsBySpec(){
        
        $statement = "Select * FROM doctors WHERE specId = " . $this->specId;
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function enterAllSpecs() {

        $specs = array(1 => 'Ортопедия', 2 => 'Кардиология', 3 => 'Дерматология', 4 => 'Вътрешни болести', 5 => 'Гастроентерология', 6 => 'ПЕдиатрия', 7 => 'Неврология', 8 => 'Акушерство и генекология', 9 => 'Урология');


        foreach ($specs as $value) {

            $query = "INSERT INTO specs(name) VALUES('" . $value . "')";
            $stmt = $this->link->query($query);
        }

        echo "good";
    }
    
    

}
