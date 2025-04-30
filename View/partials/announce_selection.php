<section id="annonce_selection" class="selection-section">
    <h2 class="selection-title">Sélectionnés pour vous</h2>
    <div class="selection-grid">
        <?php foreach ($this->annonces as $annonce): ?>
            <?php
                // Use the controller's function to prepare card data
                $cardData = $this->controller->formatAnnonceCard($annonce);

                // Create and render the card
                $card = new CardView(
                    $cardData['id'],
                    $cardData['image'],
                    $cardData['title'],
                    $cardData['description'],
                    $cardData['link']
                );
                $card->render();
            ?>
        <?php endforeach; ?>
    </div>
</section>
