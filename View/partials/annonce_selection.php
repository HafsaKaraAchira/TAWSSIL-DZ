<section id="annonce_selection" class="selection-section">
    <h2 class="selection-title">Sélectionnés pour vous</h2>
    <div class="selection-grid">
        <?php foreach ($this->annonces as $annonce): ?>
            <?php
                // Use the controller's function to prepare card data
                $data = CardView::formatFromAnnonce($annonce);
                // Create and render the card
                CardView::render($data);
            ?>
        <?php endforeach; ?>
    </div>
</section>
