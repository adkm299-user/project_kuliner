<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\KulinerModel;

class KulinerApi extends BaseController
{
    protected $kulinerModel;

    public function __construct()
    {
        $this->kulinerModel = new KulinerModel();
    }
 
    // GET /api/kuliner
    public function index()
    {
        $lat    = $this->request->getGet('lat');
        $lng    = $this->request->getGet('lng');
        $radius = $this->request->getGet('radius') ?? 5;

        $kuliners = $this->kulinerModel
                         ->select('kuliner.*, kategori.nama as kategori_nama')
                         ->join('kategori', 'kategori.id = kuliner.kategori_id')
                         ->where('kuliner.status', 'approved')
                         ->findAll();

        // Filter by radius kalau ada lat/lng
        if ($lat && $lng) {
            $kuliners = array_filter($kuliners, function($k) use ($lat, $lng, $radius) {
                if (!$k['lat'] || !$k['lng']) return false;
                $distance = $this->haversine($lat, $lng, $k['lat'], $k['lng']);
                return $distance <= $radius;
            });
            $kuliners = array_values($kuliners);
        }

        return $this->response
                    ->setStatusCode(200)
                    ->setJSON([
                        'status'  => 'success',
                        'total'   => count($kuliners),
                        'data'    => $kuliners,
                    ]);
    }

    // GET /api/kuliner/{id}
    public function show($id)
    {
        $kuliner = $this->kulinerModel
                        ->select('kuliner.*, kategori.nama as kategori_nama')
                        ->join('kategori', 'kategori.id = kuliner.kategori_id')
                        ->where('kuliner.id', $id)
                        ->first();

        if (!$kuliner) {
            return $this->response
                        ->setStatusCode(404)
                        ->setJSON([
                            'status'  => 'error',
                            'message' => 'Kuliner tidak ditemukan',
                        ]);
        }

        return $this->response
                    ->setStatusCode(200)
                    ->setJSON([
                        'status' => 'success',
                        'data'   => $kuliner,
                    ]);
    }

    // Hitung jarak dua koordinat (km)
    private function haversine($lat1, $lon1, $lat2, $lon2)
    {
        $R = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $R * $c;
    }
}