<?php

class CardView
{
    public static function formatFromAnnonce(array $annonce): array
    {
        return [
            'id' => $annonce['AnnonceID'],
            'image' => asset("/?view=HomePage&action=viewImage&link=" . rawurlencode($annonce['ImageLink'])),
            'title' => $annonce['AnnonceTypeTransport'] . '<br>' . $annonce['AnnoncePtDepart'] . '&rarr;' . $annonce['AnnoncePtArrivee'],
            'description' => substr($annonce['AnnonceDescription'], 0, 100) . '...',
            'link' => '/?view=Annonce&action=AnnonceDetails&id=' . $annonce['AnnonceID'],
        ];
    }

    public static function formatFromNews(array $news): array
    {
        return [
            'id' => $news['NewsID'],
            'image' => '', // asset("/images/news/" . rawurlencode($news['ImageLink'])),
            'title' => '', // $news['NewsTitle'],
            'description' => '', // substr($news['NewsContent'], 0, 50) . '...',
            'link' => '', // '/?view=News&action=Details&id=' . $news['NewsID'],
        ];
    }

    public static function render(array $data): void
    {
        echo <<<HTML
        <div id="card-{$data['id']}" class="card">
            <img src="{$data['image']}" alt="Card Image" class="card-image">
            <div class="card-content">
                <h5 class="card-title">{$data['title']}</h5>
                <p class="card-description">{$data['description']}</p>
                <a href="{$data['link']}" class="card-link">Lire la suite &rarr;</a>
            </div>
        </div>
        HTML;
    }
}
