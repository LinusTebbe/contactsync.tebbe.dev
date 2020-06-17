<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_People;
use Google_Service_People_ListConnectionsResponse;
use Illuminate\Support\Facades\Auth;

class XMLExportController extends Controller
{
    public function xmlPhoneBook() {
        return response()
        ->view('xmlPhonebook', [
            'contacts' => $this->getContacts()
        ])->header('Content-Type', 'text/xml');
    }


    /**
     * @return Google_Service_People_ListConnectionsResponse
     */
    private function getContacts() {
        $user = Auth::user();
        $google_client_token = [
            'access_token' => $user->access_token,
            'refresh_token' => $user->refresh_token,
            'expires_in' => $user->expires_in
        ];

        $client = new Google_Client();
        $client->setApplicationName("xmlExporter");
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setAccessToken(json_encode($google_client_token));

        $service = new Google_Service_People($client);

        $results = $service->people_connections->listPeopleConnections('people/me',[
            'requestMask.includeField' => 'person.phone_numbers,person.names,person.occupations,person.organizations'
        ]);

        return $results->getConnections();
    }
}
