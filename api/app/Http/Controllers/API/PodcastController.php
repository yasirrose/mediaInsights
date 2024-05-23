<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Podcast;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        // header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');

        // dd($request->all());
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'imageUrl' => 'required',
        ]);

        try {
            $podcast = new Podcast();

            $podcast->name = $validatedData['name'];
            $podcast->description = $validatedData['description'];

            if ($request->hasFile('imageUrl')) {
                $image = $request->file('imageUrl');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('podcast_images'), $imageName); // Move the image to the public/podcast_images folder

                // Store the image path in the database
                $podcast->imageUrl = 'podcast_images/' . $imageName;
            }

            $podcast->save();

            return response()->json($podcast);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save the podcast.'], 500);
        }
    }


    public function edit($id)
    {
        $podcast = Podcast::find($id);
        return response()->json($podcast);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $podcast = Podcast::find($id);

        if (!$podcast) {
            return response()->json(['error' => 'Podcast not found'], 404);
        }
        $podcast->name = $request->input('name');
        $podcast->description = $request->input('description');
        if ($request->hasFile('imageUrl')) {
            // Delete the old image if it exists
            if ($podcast->imageUrl && file_exists(public_path($podcast->imageUrl))) {
                unlink(public_path($podcast->imageUrl));
            }

            // Store the new image
            $image = $request->file('imageUrl');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('podcast_images'), $imageName);

            // Update the image path in the database
            $podcast->imageUrl = 'podcast_images/' . $imageName;
        }
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
                language
                isExplicitContent
                copyright
                websiteUrl
                rssUrl
                rssOwnerName
                rssOwnerPublicEmail
                authorName
                isCompleted
                isBlocked
                seriesType
                datePublished
                hash
                childrenHash
                itunesInfo{
                    uuid
                    hash
                    subtitle
                    summary
                    baseArtworkUrlOf(size:640)
                    publisherId
                    publisherName
                    country
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
