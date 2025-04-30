<?php

class CardView
{
    private $id;
    private $image;
    private $title;
    private $description;
    private $link;

    public function __construct($id, $image, $title, $description, $link)
    {
        $this->id = $id;
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
    }

    public function render()
    {
        echo <<<HTML
        <div id="card-{$this->id}" class="card">
            <img src="{$this->image}" alt="Card Image" class="card-image">
            <div class="card-content">
                <h5 class="card-title">{$this->title}</h5>
                <p class="card-description">{$this->description}</p>
                <a href="{$this->link}" class="card-link">Lire la suite &rarr;</a>
            </div>
        </div>
        HTML;
    }
}
?>