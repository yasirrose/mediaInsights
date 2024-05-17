<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use function PHPSTORM_META\type;

class PodcastController extends Controller
{
    public function index()
    {
        // Replace 'YOUR_API_KEY' with your actual API key
        $apiKey = env('TADDY_API_KEY');
        $TADDY_USER_ID = env('TADDY_USER_ID');
        $baseUrl = 'https://api.taddy.org/graphql';

        // GraphQL query
        $query = <<<'GRAPHQL'
        query {
          getPodcastSeries(name:"Planet Money"){
            uuid
            name
            itunesId
            description
            imageUrl
            itunesInfo{
              uuid
              baseArtworkUrlOf(size:640)
            }
            episodes{
                uuid
                name
                description
                audioUrl
              }
          }
        }
        GRAPHQL;
        $headers = [
            'X-USER-ID' => $TADDY_USER_ID,
            'X-API-KEY' => $apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
        // Make POST request to the GraphQL endpoint
        $client = new Client(['base_uri' => $baseUrl]);
        $response = $client->request('POST', '', [
            'headers' => $headers,
            'json' => ['query' => $query],
        ]);

        // Check if request was successful
        if ($response->getStatusCode() === 200) {
            // Parse and process the response JSON
            $podcastData = json_decode($response->getBody()->getContents(), true);
            // Return the podcast data in JSON format
            return response()->json($podcastData);
        } else {
            // Handle error response
            echo "Error: " . $response->getStatusCode() . " - " . $response->getBody()->getContents();
        }
    }
    public function podcastSearch(Request $request)
    {
        $req = $request->all();
        $searchTerm = $req['query'];
        $searchItem = $request->query('query');
        // dd($searchItem);
        $apiKey = env('TADDY_API_KEY');
        $TADDY_USER_ID = env('TADDY_USER_ID');
        $baseUrl = 'https://api.taddy.org/graphql';

        // // GraphQL query
        // $query = <<<GRAPHQL
        //     query {
        //         searchForTerm(term: "$searchTerm", filterForTypes:PODCASTEPISODE , sortByDatePublished:LATEST) {
        //             searchId
        //             podcastEpisodes{
        //                 uuid
        //                 name
        //                 description
        //                 audioUrl
        //               }
        //         }
        //     }
        //     GRAPHQL;
        // $query = <<<'GRAPHQL'
        // query {
        //   getPodcastSeries(name:"$searchItem"){
        //     uuid
        //     name
        //     itunesId
        //     description
        //     imageUrl
        //     itunesInfo{
        //       uuid
        //       baseArtworkUrlOf(size:640)
        //     }
        //     episodes{
        //         uuid
        //         name
        //         description
        //         audioUrl
        //       }
        //   }
        // }
        // GRAPHQL;
        $query = sprintf('
            query {
                getPodcastSeries(name:"%s"){
                uuid
                name
                itunesId
                description
                imageUrl
                itunesInfo{
                    uuid
                    baseArtworkUrlOf(size:640)
                }
                episodes{
                    uuid
                    name
                    description
                    audioUrl
                    imageUrl
                }
                }
            }
            ', $searchItem);
        $headers = [
            'X-USER-ID' => $TADDY_USER_ID,
            'X-API-KEY' => $apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
        // Make POST request to the GraphQL endpoint
        $client = new Client(['base_uri' => $baseUrl]);
        $response = $client->request('POST', '', [
            'headers' => $headers,
            'json' => [
                'query' => $query,
                'variables' => [
                    'searchTerm' => $searchTerm,
                ],
            ],
        ]);

        // Check if request was successful
        if ($response->getStatusCode() === 200) {
            // Parse and process the response JSON
            $podcastData = json_decode($response->getBody()->getContents(), true);
            // Return the podcast data in JSON format
            return response()->json($podcastData);
        } else {
            // Handle error response
            echo "Error: " . $response->getStatusCode() . " - " . $response->getBody()->getContents();
        }
    }
}
