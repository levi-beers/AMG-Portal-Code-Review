<?php

namespace AMGPortal\Http\Controllers\Web;

// this is 

use Illuminate\Http\Request;
use Readability\Readability;
use Masterminds\HTML5;
use Illuminate\Support\Facades\Http;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Repositories\Country\CountryRepository;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Exception\ParseException;
use Validator;

class ContentToolController extends Controller
{

    public function __construct(
        private UserRepository $users,
        private RoleRepository $roles,
        private CountryRepository $countries
    ) {
        // Allow access to authenticated users only.
        $this->middleware('auth');

        // Allow access to users with 'users.manage' permission.
        $this->middleware('permission:contenttool.lookup');
    }

    public function index()
    {
        $roles = $this->roles->all()->filter(function ($role) {
            return $role->id == auth()->user()->role_id;
        })->pluck('name', 'id');

        return view('tools.content-tool', [
            'user' => auth()->user(),
            'edit' => true,
            'roles' => $roles,
            'countries' => [0 => __('Select a Country')] + $this->countries->lists()->toArray(),
            'socialLogins' => $this->users->getUserSocialLogins(auth()->id()),
            'statuses' => UserStatus::lists()
        ]);
    }

    public function search(Request $request)
    {

        $post_request = $request->except("_token");
        $search_term = $post_request["search_term"];
        Log::info("Search Term is: " . $post_request["search_term"]);

        $offset = "0";
        $myresult = "https://api.bing.microsoft.com/v7.0/news/search?q=" . $search_term . "&mkt=en-us&sortby=date&count=100&offset=" . $offset;

        $response = Http::withHeaders([
            'Ocp-Apim-Subscription-Key' => '96fa612c33bf4ce5b4973fc1236f881d',
            'Content-Type' => 'application/json'
        ])->get($myresult, [
            'q' => $search_term,
            'count' => '100',
            'mkt' => 'en-us',
            'sortby' => 'date',
            'offset' => $offset
        ]);

        $json_data = json_decode($response->body());

        Log::info(json_encode($json_data->value));
        foreach ($json_data->value as $mydata) {
            $name = $mydata->name;
            $url = $mydata->url;
            $provider = $mydata->provider[0]->name;
            Log::info('Name:[' . $name . ']');
        }
        //$this->updatesetting($request->except("_token"));
        //
        $roles = $this->roles->all()->filter(function ($role) {
            return $role->id == auth()->user()->role_id;
        })->pluck('name', 'id');

        return view('tools.search-results', [
            'user' => auth()->user(),
            'edit' => true,
            'roles' => $roles,
            'search_term' => $search_term,
            'json_data' => $json_data,
            'countries' => [0 => __('Select a Country')] + $this->countries->lists()->toArray(),
            'socialLogins' => $this->users->getUserSocialLogins(auth()->id()),
            'statuses' => UserStatus::lists()
        ]);
    }

    public function scrape(Request $request)
    {
        $url = $request->input('url');

        $contextOptions = [
            'http' => [
                'ignore_errors' => true,
            ],
        ];

        $context = stream_context_create($contextOptions);

        $html = @file_get_contents($url, false, $context);
        
        if ($html === false) {
            if (strpos($http_response_header[0], '403 Forbidden') !== false) {
                $title = 'Error: Access to the resource is forbidden.';
            } elseif (strpos($http_response_header[0], '404 Not Found') !== false) {
                $title = 'Error: The requested resource was not found.';
            } else {
                $title = 'Error: An HTTP error occurred.';
            }
        } else {
            $readability = new Readability($html, $url);

            $result = $readability->init();

            if ($result) {
                $title = $readability->getTitle()->textContent;
                $content = $readability->getContent()->innerHTML;
            } else {
                $title = 'Looks like we couldn\'t find the content.';
            }
        }

        return view('tools.scrape-content', [
            'user' => auth()->user(),
            'title' => $title ?? null,
            'content' => $content ?? null
        ]);
    }
}
