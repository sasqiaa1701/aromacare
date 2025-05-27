<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{

    public function getDestinations(Request $request)
    {

        $search = $request->query('search');

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'key' => config('services.rajaongkir.key'),
        ])->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination', [
            'search' => $search,
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => $response->json()], 500);
        }
    }

    public function cekOngkir(Request $request)
    {
        $request->validate([
            'destination' => 'required|string',
            'courier' => 'required|string',
        ]);
        $response = Http::asForm()->withHeaders([
            'Accept' => 'application/json',
            'Key' => config('services.rajaongkir.key'),
        ])->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
            'origin' => config('services.rajaongkir.origin_id'),
            'destination' => $request->destination,
            'weight' => 1,
            'courier' => $request->courier,
            'price' => 'lowest',
        ]);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'data' => $response->json()['data'] ?? []
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghubungi API RajaOngkir',
            'error' => $response->json(),
        ], $response->status());
    }
}
