<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $secretKey = 'Qw3rty09!@#';

    // Generate Bearer Token
    public function generateToken(Request $request)
    {
        $name = $request->name;
        $dateRequest = $request->date_request;

        // expired 1 jam
        $exp = time() + 3600;

        // token sederhana
        $rawToken = $name . '|' . $dateRequest . '|' . $exp . '|' . $this->secretKey;

        $token = base64_encode($rawToken);

        return response()->json([
            'name' => $name,
            'date_request' => $dateRequest,
            'token' => $token,
            'exp' => $exp
        ]);
    }

    // API dengan Bearer Token
    public function customerItems(Request $request)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader) {
            return response()->json([
                'message' => 'Bearer token tidak ditemukan'
            ], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);

        // decode token
        $decoded = base64_decode($token);

        // cek secret key
        if (!str_contains($decoded, $this->secretKey)) {
            return response()->json([
                'message' => 'Token tidak valid'
            ], 401);
        }

        return response()->json([
            'result' => [
                [
                    'name_customers' => $request->name_customers,
                    'items' => 'Lampu bohlam LED 20 WATT',
                    'dicount' => '0,02',
                    'fix_price' => '19600'
                ],
                [
                    'name_customers' => $request->name_customers,
                    'items' => 'Mouse wireless logitech',
                    'dicount' => '0,035',
                    'fix_price' => '175000'
                ]
            ]
        ]);
    }
}
