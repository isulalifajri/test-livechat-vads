<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MasterCustomerController extends Controller
{

    public function masterCustomer()
    {
        return view('cms.masterCust.index');
    }

    public function masterCustomerData()
    {
        $response = Http::get(
            'https://randomuser.me/api?results=10&page=1'
        );

        $results = collect(
            $response->json()['results']
        )->map(function ($item) {

            return [

                'name' => $item['name']['title'] . ' ' .
                        $item['name']['first'] . ' ' .
                        $item['name']['last'],

                'email' => $item['email'],

                'login' => [
                    'uuid' => $item['login']['uuid'],
                    'username' => $item['login']['username'],
                    'password' => $item['login']['password'],
                ],

                'phone' => $item['phone'],

                'cell' => $item['cell'],

                'picture' => [
                    'medium' => $item['picture']['medium'],
                ],

            ];

        });

        return response()->json([
            'results' => $results,
        ]);
    }

}
