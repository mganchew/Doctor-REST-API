<?php

class RestModel
{

    protected $msg;

    public function getClient(){

        $client_email = '319250874787-uol4a4pfao97qmdn4orrb4ssdmdot21q@developer.gserviceaccount.com';
        $private_key = "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDIR5UzEVNKq+/y\nGWsw1xVm861mr2w+mMNl/uhwL+iiMTJWgj8HKqFzy2aAIPFDnZuLkilBx5L9qLRh\n0C673ZLmKT2q8c3VD5jyzaEIbJOyS3QynWDK1S39H8I1NMrhSzMhmIoQ22yAGYWw\n1vuwvselMpwWBU9h5H5KRdYuxuPTnpEuFgBAkQ8TXsf0ouflKSufJtx7a/5y6cjw\n82/dVcXmi0ns15RWBIDQ64c24ojTQgQq058fI7cliDaZ5+y4XXCFtBWces6fcKxo\nePo6wctTQFJnSSen5IoTV0E7nEAIdmFetEoPBS6hz/77BrcRuRJG2edVcPQL6Vtl\ntTei+qWLAgMBAAECggEAeTyb3KYIPZOHVI5+jLomgoPP2/ElHV9sKTn9iqv1rvkI\n98UwUi5EPcxK6BUI911Y40w/HUqqeFK/ntZe8+pVGm6sneZyKx+d/pzrdiYD4lI6\nrMkH5sDVbfzjm0Gx7l+PPC8SpNGvBHxuqXX6NivGvwG76ricLS4cJOnRlc9f6qFn\nGorWf2piFX7NneziI7Yc08nHijcNZie4otDXUhe5Y+iEGCvnFzldk6N+tCPerijR\n0Hdu7MNN7CWXoA0O4AqJsuwIDRu1sB7N11JzuNMKf0DCU/6ToIAoKC/g6XIT8NYx\nHQwirQk5eoM9tD5OQVMpYlPwMHKh4z+Mo73/bRIaAQKBgQD3Xf3Clzdaw6ShsnbM\nGh9I+F9TE8h5zqDaP7YzfSgwTI+trUBZuqa8Mgg9+hqNSwvu/7eEBhEbrXDqIZBq\n4+BMRvUzY6sPs/05OPyGts3V9hheuIuAbIyUChqCUIZl6Bjf6MUSVYeIAlMcOVA6\nsFTr7vfh+eqIBssft6xvK8gs4QKBgQDPROfc9N6f68dYTXYwBo8Eten/5/u+rzIs\nn7q35C9eZIpZSd0htEwiLnICaaAPPTSwZDJ2cbIN6+k589ifvRgnuGKCqOm+8lbq\nWByeZK1eMi84dz1sYx7pv101setHmcT/c8i1Xj9Mq8ucI6sCZZ18XSpupAmiIoi7\nlMYDgLzT6wKBgQDwUfpU8IAwx93L0gwkIkS+qb5CgffEjwAqyLcEstU2h0sXGjho\ndDPEpn7nZ3IgTwaa/QiXVSWN1CTc8hrSHe0tbcqOUIhCS0T6MOj1H+g9tEbcz0GI\nVO0GbgJvFDheDO0Nq6C6PSnc8xU3WF8fhWwbgyCEBD7cRG1WtSTrJIfnQQKBgQCe\nfSES+wc0n/T5l5nVFV7NClFZBkmgwJSMPMNpFAoIkrabmfiGajiBNqSlJaFnpbSh\nYKyZl0zAinD3iHdPhidvT/W71W+PO/2sCh4wG+nZimRDOCJ2u8CKmnKquVaglHtn\nnmCOFvguJ3t09G0yUwM+cnscyUA4g1GsphFX4lwBawKBgAdpjDtj2sdpX4qeAiJl\nMsUqkUepAN2L+GXQZSoOdFo7w2TLKT1fJG3Mav6f20XDENpcQUFBI1h2xBNMDfez\nV4V16Il8v2EPb5YtAcML4VHwi3W2GtZH5hL/NbwPV/1CALdDgd20jIkG6mtTTcSq\n2cklk6Mgoux2PcKfcu20bXJH\n-----END PRIVATE KEY-----\n";
        $scopes = array('https://www.googleapis.com/auth/calendar');
        $credentials = new Google_Auth_AssertionCredentials(
            $client_email,
            $scopes,
            $private_key
        );

        $client = new Google_Client();
        $client->setAssertionCredentials($credentials);
        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion();
        }

        return $client;

    }

    public function appointment()
    {
        $data = $this->getFromPost();

        if($this->checkDB() !== true){
            $this->msg = "appointment already exists pick a new date or doctor";
            return $this->msg;
        }else{
            $this->insertInDB($data);
            $this->insertInCalendar($data);
            $this->msg = "Appointment created.";
        }

        return json_encode($this->msg);

    }

    public function checkDB()
    {

        //TODO: Select * FROM WHERE doctor = $doctor and time = $time
        //TODO: Return true or false
        return true;
    }

    public function insertInDB()
    {

        //TODO: Appointment insert


    }

    public function insertInCalendar($data)
    {

        $client = $this->getClient();

        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event(array(
            'summary' => 'Test Calendar',
            'location' => 'Plovdiv',
            'description' => 'A chance to hear more about Google\'s developer products.',
            'start' => array(
                'dateTime' => '2015-07-12T08:25:00+03:00',
                'timeZone' => 'Europe/Sofia',
            ),
            'end' => array(
                'dateTime' => '2015-07-12T09:00:00+03:00',
                'timeZone' => 'Europe/Sofia',
            ),
            'recurrence' => array(
                'RRULE:FREQ=DAILY;COUNT=1'
            ),
            'attendees' => array(
                array('email' => 'ev0nappy@gmail.com'),
                array('email' => 'wska.bby93@gmail.com'),
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
        printf('Event created: %s\n', $event->htmlLink);

    }

    public function checkAppointment()
    {

        //TODO: Return all appointments after current date
        return "no appointments";
    }

    public function register()
    {

        //TODO: Register logic comes here

    }

    public function getFromPost(){

        echo "post";

    }


}