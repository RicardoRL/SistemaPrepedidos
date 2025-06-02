<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BanxicoService
{
  protected $url = 'https://www.banxico.org.mx/SieAPIRest/service/v1/';
  protected $serie = 'SF43718';

  public function obtenerTipoCambio()
  {
    $token = env('BANXICO_TOKEN');

    $response = Http::withHeaders([
      'Bmx-Token' => $token,
    ])->get("{$this->url}series/{$this->serie}/datos/oportuno");

    if ($response->successful()) {
      return $response->json()['bmx']['series'][0]['datos'][0]['dato'] ?? null;
    }

    return null;
  }
}
