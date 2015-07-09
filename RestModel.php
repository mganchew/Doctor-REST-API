<?php

class RestModel{

    public function appointment(){

        //TODO: Check for already existing appointment
        //TODO: if there isnt any make a new appointment in the database
        //TODO: insert the date and hour in the doctor and user google calendar
        //TODO: return json string "appointment already exists pick a new date or doctor" or "appointment registered"
        return "testing";
    }


    public function checkDB(){

        //TODO: Select * FROM WHERE doctor = $doctor and time = $time
        //TODO: Return true or false

    }

    public function insertAppointment(){

        //TODO: Appointment insert


    }

    public function insertInCalendar(){

        //TODO: Insert into google calendar

    }

    public function checkAppointment(){

        //TODO: Return all appointments after current date
        return "no appointments";
    }

    public function register(){

        //TODO: Register logic comes here

    }


}