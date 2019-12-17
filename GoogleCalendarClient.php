<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

$dotenv->load();


/**
* Class GoogleCalendarClient makes API calls to Google API
*/
class GoogleCalendarClient
{
   protected $service;

   /**
    * GoogleCalendarClient constructor
    */
   public function __construct()
   {
       $apiKey = getenv( 'GOOGLE_API_KEY' );
      
       $client = new Google_Client();
       $client->setAccessType( 'offline' );
       $client->useApplicationDefaultCredentials();
       $client->setDeveloperKey( $apiKey );
       $client->setScopes( [ 'https://www.googleapis.com/auth/calendar' ] );
      
       $this->service = new Google_Service_Calendar( $client );
   }

   /**
    * Creates an event
    *
    * @param array $eventDetails event details e.g summary, start, end, attendees, e.t.c
    *
    * @return array $user of a user
    */
   public function createEvent( $eventDetails )
   {
       $event = new Google_Service_Calendar_Event( $eventDetails );

       $optionalArguments = [ 'sendNotifications' => true ];
       $calendarId = 'primary';
       $event = $this->service->events
           ->insert( $calendarId, $event, $optionalArguments );

       return $event;
   }
}