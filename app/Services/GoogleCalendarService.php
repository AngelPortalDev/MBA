<?php
// app/Services/GoogleCalendarService.php
namespace App\Services;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Support\Facades\DB;

class GoogleCalendarService
{
    protected $client;
    protected $calendar;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('app/google-calendar/credentials.json'));
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
        $this->client->setAccessType('offline');
        $this->client->setRedirectUri('https://20e3-110-226-176-73.ngrok-free.app/google/callback');

        // if (session()->has('google_token')) {
        //     $this->client->setAccessToken(session('google_token'));
        // }
        $row = DB::table('google_tokens')->where('id', 1)->where('is_deleted', 'No')->first();
            if ($row) {
                $token = json_decode($row->token, true);
                $this->client->setAccessToken($token);

                if ($this->client->isAccessTokenExpired() && isset($token['refresh_token'])) {
                    $newToken = $this->client->fetchAccessTokenWithRefreshToken($token['refresh_token']);
                    $token = array_merge($token, $newToken);
                    $this->client->setAccessToken($token);

                    DB::table('google_tokens')->updateOrInsert(
                        ['id' => 1],
                        ['token' => json_encode($token), 'updated_at' => now()]
                    );
                }
            }
        $this->calendar = new Google_Service_Calendar($this->client);
    }

    public function createGoogleMeetEvent($data)
    {

        $event = new \Google_Service_Calendar_Event([
            'summary' => $data['summary'],
            'description' => $data['description'],
            'start' => ['dateTime' => $data['start']->toRfc3339String(), 'timeZone' => 'Europe/Malta'],
            'end' => ['dateTime' => $data['end']->toRfc3339String(), 'timeZone' => 'Europe/Malta'],
            'attendees' => [['email' => $data['attendee_email']]],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => uniqid(),
                    'conferenceSolutionKey' => ['type' => 'hangoutsMeet'],
                ],
            ],
        ]);

        $calendarId = 'primary';

        $event = $this->calendar->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);

        return $event->getHangoutLink();
    }

    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function handleCallback($code)
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
                if (isset($token['access_token'])) {
                    // session(['google_token' => $token]);

                    DB::table('google_tokens')->updateOrInsert(
                        ['id' => 1],
                        [
                            'token' => json_encode($token),
                            'updated_at' => now(),
                            'is_deleted' => 'No'
                        ]
                    );

                    $this->client->setAccessToken($token);
                }
    }
}
