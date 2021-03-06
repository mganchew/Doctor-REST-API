<?php

class RestModel
{

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
    protected $fileContent;
    protected $userInfo;
    protected $workAddress;
    protected $doctorFlag;
    protected $searchField;
    protected $rating;
    protected $authToken;
    protected $curl;
    protected $heartrate;

    public function __construct($data)
    {

        $this->link = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        $this->curl = new CurlGoogleFit();
        if ($data['user']) {
            $this->user = $data['user'];
        }

        if ($data['specId']) {
            $this->specId = $data['specId'];
        }

        if ($data['password']) {
            $this->password = $data['password'];
        }

        if ($data['email']) {
            $this->user = $data['email'];
        }

        if ($data['loginInfo']) {
            $this->loginInfo = $data['loginInfo'] * 1;
        }

        if ($data['userId']) {
            $this->userId = $data['userId'];
        }

        if (count($data) > 4 && isset($data['month'])) {

            $this->setDataForAppointment($data);
        }
    }

    public function setDataForRating($data)
    {
        $this->rating = $data['rating'];
        $this->userId = $data['userId'];
        $this->doctor = $this->prepareDataForRating($data['email']);
    }

    public function prepareDataForRating($email)
    {

        $statement = "SELECT id FROM doctors where email = '" . $email . "'";

        try {

            $stmt = $this->link->query($statement);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result[0]['id'];
        } catch (Exception $e) {
            return false;
        }
    }

    public function getDataForRating($data)
    {

        $this->email = $data['user'];
    }

    public function setDoctorRating()
    {

        $statement = "INSERT INTO ratings(doctor_id,rating,user_id) 
            VALUES('" . $this->doctor . "',"
            . "'" . $this->rating . "',"
            . "'" . $this->userId . "')";

        try {

            $this->link->query($statement);

            $response = ['msg' => 'Успешно запазихте своя рейтинг.'];
        } catch (Exception $e) {
            return json_encode($e);
        }

        return json_encode($response);
    }

    public function getDoctorRating()
    {

        $statement = "select d.id, d.email, round(avg(r.rating),1) as average"
            . " from doctors as d right join ratings as r"
            . " on d.id = r.doctor_id where d.email = '" . $this->email . "'"
            . " group by d.id";

        try {

            $stmt = $this->link->query($statement);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return json_encode($result);
        } catch (Exception $e) {
            return json_encode($e);
        }
    }

    public function setDataForAppointment($data)
    {

        $this->hour = $data['hour'];
        $this->month = $data['month'];
        $this->year = $data['year'];
        $this->day = $data['day'];
        $this->doctor = trim($data['doctor']);
        $this->spec = $data['spec'];
        $this->location = $data['address'];
        $this->userId = $data['userId'];
        $this->fileContent = $data['file'];
        $statement = "Select * FROM users WHERE id = '$this->userId'";
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->user = $result[0]['email'];
    }

    public function setDataForRegistration($data)
    {

        $this->user = $data['email'];
        $this->fName = $data['fName'];
        $this->lName = $data['lName'];
        $this->password = $data['password'];
        if ($data['specId']) {
            $this->specId = $data['specId'] * 1;
        }
    }

    public function getClient()
    {

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

    public function appointment()
    {

        if ($this->checkDB() !== false) {
            $this->msg = array(
                "msg" => "Избраният от вас час е вече зает.Моля изберете нов час или различен доктор!",
                "status" => 'notOk',
                "redirectPage" => "appointments.php"
            );
        } else {
            $this->insertInDB();

            $this->insertInCalendar();
            $this->fileUpload();
            $this->msg = array(
                "msg" => "Часът е успешно запазен.",
                "redirectPage" => "appointments.php",
                "status" => "ok"
            );
        }

        return json_encode($this->msg);
    }

    public function setTime()
    {

        $this->time = $this->day . "/" . $this->month . "/" . $this->year .
            "-" . $this->hour;
    }

    public function checkDB()
    {

        $this->setTime();
        $statement = "Select * FROM appointments"
            . " WHERE doctor = '$this->doctor' and time = '$this->time'";
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function insertInDB()
    {

        $statement = "INSERT INTO appointments(doctor,time,userId)"
            . " VALUES('" . $this->doctor . "', '" . $this->time . "',$this->userId)";
        $this->link->exec($statement);
    }

    public function insertInCalendar()
    {

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

    public function setDataForAppointmentCheck($data)
    {

        $this->user = $data['user'];
        $this->doctorFlag = $data['userInfo'] * 1;
    }

    public function checkAppointment()
    {

        $statement = "Select * FROM appointments WHERE userId = '$this->userId'";

        if ($this->doctorFlag == 2) {
            $statement = "Select doctor,time,lName,fName,email FROM appointments"
                . " RIGHT JOIN users ON users.id = appointments.userId"
                . " WHERE doctor = '$this->user'";
        }

        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


        if (count($result) == 0) {
            $this->msg = array("Message" => "Няма намери часове.");
            return json_encode($this->msg);
        }


        return json_encode($result);
    }

    public function login()
    {

        $statement = "Select * FROM users WHERE"
            . " email = '$this->user' and password = '$this->password'";

        if ($this->loginInfo == 2) {
            $statement = "Select * FROM doctors"
                . " WHERE email = '$this->user' and password = '$this->password'";
        }

        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $redirection = 'no redirection';
        $status = 'notOk';

        if ($result) {
            $this->userId = $result[0]['id'];
            $redirection = 'uploadFileForm.php';
            $userInfo = 1;
            if ($this->loginInfo == 2) {
                $userInfo = 2;
                $redirection = 'appointments.php';
            }
            $status = 'Ok';
        }

        $response = [
            'user' => $this->user,
            'userId' => $this->userId,
            'userInfo' => $userInfo,
            'redirectPage' => $redirection,
            'status' => $status
        ];
        return json_encode($response);
    }

    public function setDataForProfile($data)
    {
        $this->user = $data['user'];
        $this->doctorFlag = $data['doctorFlag'] * 1;
    }

    public function loadProfileInfo()
    {

        $table = 'users';
        if ($this->doctorFlag == 2) {
            $table = 'doctors';
        }
        $statement = "Select * FROM $table WHERE email = '$this->user'";


        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            $this->userId = $result[0]['id'];
            $response = ['data' => $result[0]];
            return json_encode($response);
        }
    }

    public function getAllSpecs()
    {

        $statement = "Select * FROM specs";

        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getSpecsWithDoctors()
    {

        $statement = "Select specs.id, specs.name FROM specs RIGHT JOIN doctors"
            . " ON specs.id = doctors.specId group by specs.id";

        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function Registration()
    {


        $statement = "INSERT INTO users(fName,lName,email,password) "
            . "VALUES('" . $this->fName . "',"
            . "'" . $this->lName . "',"
            . "'" . $this->user . "',"
            . "'" . $this->password . "')";

        if ($this->specId) {
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

    public function selectDoctorsBySpec()
    {

        $statement = "Select * FROM doctors WHERE specId = " . $this->specId;
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function fileUpload()
    {

        $statement = "INSERT INTO file(file,doctor)"
            . " VALUES('" . $this->fileContent . "','" . $this->doctor . "')";
        $stmt = $this->link->query($statement);
    }

    public function loadUpdateInfo($data)
    {

        $this->user = $data['email'];
        $this->fName = $data['fName'];
        $this->lName = $data['lName'];
        $this->userInfo = $data['userInfo'];

        if ($data['doctorFlag'] == "1") {
            $this->doctorFlag = 1;
            $this->spec = $data['specId'] * 1;
            $this->workAddress = $data['workAddress'];
        }
    }

    public function updateProfile()
    {


        $statement = "UPDATE users SET fName='" . $this->fName . "',"
            . " lName='" . $this->lName . "',userInfo = '" . $this->userInfo . "'"
            . " WHERE email='" . $this->user . "'";

        if ($this->doctorFlag == 1) {
            $statement = "UPDATE doctors SET fName='" . $this->fName . "',"
                . " lName='" . $this->lName . "',userInfo = '" . $this->userInfo . "'"
                . ",specId = " . $this->spec . ","
                . " workAddress = '" . $this->workAddress . "'"
                . " WHERE email='" . $this->user . "'";
        }
        //return json_encode($statement);
        try {
            $this->link->query($statement);
        } catch (Exception $e) {
            return json_encode($e);
        }

        $response = ['msg' => 'Успешно обновихте вашият профил'];

        return json_encode($response);
    }

    public function checkFiles()
    {

        $statement = "Select * FROM file WHERE doctor = '" . $this->user . "'";
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function enterAllSpecs()
    {

        $specs = array(
            1 => 'Ортопедия',
            2 => 'Кардиология',
            3 => 'Дерматология',
            4 => 'Вътрешни болести',
            5 => 'Гастроентерология',
            6 => 'ПЕдиатрия',
            7 => 'Неврология',
            8 => 'Акушерство и генекология',
            9 => 'Урология'
        );


        foreach ($specs as $value) {

            $query = "INSERT INTO specs(name) VALUES('" . $value . "')";
            $stmt = $this->link->query($query);
        }

        echo "good";
    }

    public function loadSearchData($data)
    {

        $this->searchField = $data['searchField'];
    }

    public function search()
    {
        $statement = "Select lName,fName,workAddress,email,name FROM doctors"
            . " RIGHT JOIN specs ON specs.id = doctors.specId"
            . " WHERE lName = '" . $this->searchField . "'";
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function setUserDataForRating($data)
    {

        $this->userId = $data['userId'];
        $this->doctor = $this->prepareDataForRating($data['email']);
    }

    public function getUserRatingInfoForDoctor()
    {

        $statement = "SELECT * FROM ratings"
            . " WHERE user_id = $this->userId AND doctor_id = $this->doctor";
        $stmt = $this->link->query($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function setDataForGoogleFit($data)
    {

        $this->authToken = $data['token'];
        file_put_contents(__DIR__ . '/templates/authToken.json', json_encode(['token' => $this->authToken]));
        $this->userId = $data['userId'];
    }

    public function setDataForGoogleFitInsert($data)
    {

        $this->userId = $data['userId'];
        $this->heartrate = $data['heartrate'];
    }


    public function checkAndCreateResources()
    {

        $this->curl->setUrl('https://www.googleapis.com/fitness/v1/users/me/dataSources');
        $data = json_decode($this->curl->getResponse());
        $heartbeat = false;
        foreach ($data as $key => $value) {

            if ($value[0]->dataStreamName == 'hearthbeat123') {
                $heartbeat = true;
                $response = ['msg' => 'Resource already created', 'resource' => $value[0]];
            }
        }

        if ($heartbeat !== true) {
            if ($this->createResource()) {
                $response = ['msg' => 'Resource created!'];
            } else {
                $response = ['msg' => 'Could not create Resource. Try again later'];
            }
        }

        return json_encode($response);
    }

    public function createResource()
    {

        $body = json_decode(file_get_contents(__DIR__ . '/templates/createResource.json'), true);
        $body['dataStreamName'] = 'hearthbeat123456';
        $body['dataType']['field'][0]['name'] = 'heartbeat123456';
        $body['dataType']['field'][0]['format'] = 'integer';

        $bodyToPost = json_encode($body);
        $this->curl->setUrl('https://www.googleapis.com/fitness/v1/users/me/dataSources');
        $this->curl->setMethod('POST');
        $this->curl->setPostData($bodyToPost);
        $response = json_decode($this->curl->getResponse(), true);

        if (array_key_exists('error', $response)) {
            return false;
        }

        return true;
    }

    public function insertDataSetInGoogleFit()
    {

        $body = json_decode(file_get_contents(__DIR__ . '/templates/getUserData.json'), true);

        $nanoTime = $this->getNanoTime();
        $body['maxEndTimeNs'] = $nanoTime['end'] + 10000;
        $body['minStartTimeNs'] = $nanoTime['start'];
        $body['point'][0]['endTimeNanos'] = $nanoTime['end'];
        $body['point'][0]['startTimeNanos'] = $nanoTime['end'];
        $body['point'][0]['value'][0]['intVal'] = $this->heartrate;


        $resourceData = json_decode($this->checkAndCreateResources(), true);
        $urlTemplate = 'https://www.googleapis.com/fitness/v1/users/me/dataSources/<dataSourceId>/datasets/0-0';

        $urlWithDataSource = str_replace('<dataSourceId>', $resourceData['resource']['dataStreamId'], $urlTemplate);

        $url = str_replace(' ', '%20', $urlWithDataSource);

        $bodyToPost = json_encode($body);
        $this->curl->setUrl($url);
        $this->curl->setMethod('PATCH');
        $this->curl->setPostData($bodyToPost);

        $response = json_decode($this->curl->getResponse(), true);

        //TODO change the value and uncomment db insertion
         $this->insertMeasurementsInDB($this->heartrate, $nanoTime['end']);
        //return json_encode(['msg'=>'ok']);
        return json_encode($response);
    }

    protected function insertMeasurementsInDB($value, $time)
    {
        $statement = "INSERT INTO measurements(userId,heartrate,date) 
            VALUES('" . $this->userId . "',"
            . "'" . $value . "',"
            . "'" . $time . "')";

        try {

            $this->link->query($statement);

            $response = ['msg' => 'Успешно запазихте вашите измервания.'];
        } catch (Exception $e) {
            return json_encode($e);
        }
    }

    public function getAllDataSetsForUser()
    {

        $nanoTime = $this->getNanoTime();

        $start = $nanoTime['start'];
        $end = $nanoTime['end'];
        $resourceData = json_decode($this->checkAndCreateResources(), true);
        //return json_encode($resourceData);
        $urlTemplate = 'https://www.googleapis.com/fitness/v1/users/me/dataSources/<dataSourceId>/datasets/' . $start . '-' . $end;
        $urlWithDataSource = str_replace('<dataSourceId>', $resourceData['resource']['dataStreamId'], $urlTemplate);
        $url = str_replace(' ', '%20', $urlWithDataSource);
        $this->curl->setUrl($url);
        $this->curl->setMethod('GET');
        $response = json_decode($this->curl->getResponse(), true);

        return json_encode($response);
    }

    public function prepareDataForMeasurements($data)
    {
        $email = $data['email'];
        $statement = "SELECT id FROM users WHERE email = '" . $email . "'";
        $stmt = $this->link->query($statement);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->userId = $result[0]['id'];

    }

    public function getAllDataSetsForUserFromDB()
    {

//        return json_encode(['msg'=>$this->userId]);
        $statement = 'SELECT * FROM measurements WHERE userId = ' . $this->userId;
        //$statement = 'SELECT * FROM measurements WHERE userId = 1';
        $stmt = $this->link->query($statement);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $value) {

            //var_dump($value);exit();
            $arrToPush['endTimeNanos'] = $value['date'];
            $arrToPush['value'][0]['intVal'] = $value['heartrate'];
            $array['point'][] = $arrToPush;
        }

        return json_encode($array);

    }

    public function getNanoTime()
    {
        $time = microtime();
        $timeParts = explode(' ', $time);

        $timestamp = $timeParts[1];

        $microTimeParts = explode('.', $timeParts[0]);
        $micro = $microTimeParts[1];
        $startTime = (($timestamp - 24 * 60 * 60) . $micro) * 10;
        $endTime = ($timestamp . $micro) * 10;

        return ['start' => intval($startTime), 'end' => intval($endTime)];
    }

}