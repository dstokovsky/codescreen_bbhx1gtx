<?php
/**
 * Service that retrieves data from the CodeScreen Films API.
 */
class FilmsAPIService
{
    private static array $films = [];

    private $FILMS_ENDPOINT_URL = "https://app.codescreen.com/api/assessments/films";

    //Your API token. Needed to successfully authenticate when calling the films endpoint.
    //This needs to be included in the Authorization header in the request you send to the films endpoint.
    private $API_TOKEN = "8c5996d5-fb89-46c9-8821-7063cfbc18b1";

    public function __construct(private \Psr\Http\Client\ClientInterface $client) {}

    /**
     * Retrieves the data for all films by calling the https://app.codescreen.dev/api/assessments/films endpoint.
    */
    public function getFilmData()
    {
        if (!empty(self::$films)) {
            return self::$films;
        }

        $headers = [
            'Authorization' => 'Bearer ' . $this->API_TOKEN,
            'Accept' => 'application/json',
        ];
        $response = $this->client->request('GET', $this->FILMS_ENDPOINT_URL, ['headers' => $headers]);

        return self::$films = json_decode($response->getBody()?->getContents() ?? '', true);
    }
    
}
