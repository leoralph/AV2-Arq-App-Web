<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IbgeService
{
    public function getNewsAndReleases(?string $only = null)
    {
        $url = 'https://servicodados.ibge.gov.br/api/v3/noticias';

        $query = $only ? ['tipo' => $only] : [];

        return Http::get($url, $query)->json();
    }

    public function getNews()
    {
        return $this->getNewsAndReleases('noticias');
    }

    public function getReleases()
    {
        return $this->getNewsAndReleases('releases');
    }
}
