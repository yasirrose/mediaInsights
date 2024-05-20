<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Podcast;

use function PHPSTORM_META\type;

class PodcastController extends Controller
{
    public function index()
    {
        // dd('aim here');
        $podcasts = Podcast::all();
        return response()->json($podcasts);
    }

    public function store(Request $request)
    {
        dd('aim here at save');
        $podcast = new Podcast();
        $podcast->title = $request->input('name');
        $podcast->description = $request->input('description');
        $podcast->image = $request->input('imageUrl');
        $podcast->save();
        return response()->json($podcast);
    }

    public function show($id)
    {
        $podcast = Podcast::find($id);
        return response()->json($podcast);
    }

    public function update(Request $request, $id)
    {
        $podcast = Podcast::find($id);
        $podcast->title = $request->input('title');
        $podcast->description = $request->input('description');
        $podcast->image = $request->input('image');
        $podcast->save();
        return response()->json($podcast);
    }

    public function destroy($id)
    {
        $podcast = Podcast::find($id);
        $podcast->delete();
        return response()->json(['message' => 'Podcast deleted successfully']);
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

    public function create(Request $request)
    {
        dd('aim here');
    }
}
