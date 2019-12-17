<?php

include_once( 'GoogleCalendarClient.php' );

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {

   $userDetails = $_REQUEST[ 'Memory' ];

   $userDetails = json_decode( $userDetails );

   $userDetails = $userDetails->twilio->collected_data->user_details->answers;

   $firstName = $userDetails->user_first_name->answer;

   $appointmentDate = $userDetails->appointment_date->answer;

   $appointmentTime = $userDetails->appointment_time->answer;

   $appointmentStartAndEndTime = formatAppointmentTime( $appointmentDate, $appointmentTime );

   $eventDetails = array(
       'summary' => $firstName.'\'s Appointment with Charles',
       'location' => 'Plaza, Rabai Rd, Nairobi, Kenya',
       'description' => $userDetails->appointment_purpose->answer,
       'start' => array(
           'dateTime' => $appointmentStartAndEndTime[0],
           'timeZone' => 'Africa/Nairobi',
       ),
       'end' => array(
           'dateTime' => $appointmentStartAndEndTime[1],
           'timeZone' => 'Africa/Nairobi',
       ),
       'attendees' => array(
           array( 'email' => 'devat73@gmail.com' ),
           array( 'email' => $userDetails->user_email->answer ),
       ),
       'reminders' => array(
           'useDefault' => FALSE,
           'overrides' => array(
           array( 'method' => 'email', 'minutes' => 24 * 60 ),
           array( 'method' => 'popup', 'minutes' => 10 ),
           ),
       ),
   );

   $client = new GoogleCalendarClient();

   $client->createEvent( $eventDetails );

   $message = "Thanks $firstName, your appointment has been booked for $appointmentDate at $appointmentTime";

   $response = array(
       'actions' => array (
           array(
               'say' => $message
           )
       )
   );

   echo json_encode( $response );
}

/**
* Formats the date to the format 2015-05-28T09:00:00
* and adds 30 minutes to the start time. This works
* with the assumption that an appointment is 30 minutes.
*
* @param String $date
* @param String $time
*
* @return Array
*/
function formatAppointmentTime($date, $time) {

   $appointmentTime = array();

   $start = date( 'Y-m-d H:i:s', strtotime( $date.$time ) );

   $end = date( 'Y-m-d H:i:s', strtotime( $start . '+30 minutes' ) );

   $start = str_replace( ' ', 'T', $start );

   $end = str_replace( ' ', 'T', $end );

   array_push( $appointmentTime, $start, $end );

   return $appointmentTime;
}