<!-- filepath: /var/www/html/TAWSSIL-DZ/View/partials/diaporama.php -->
<script src="<?= APP_URL ?>/Assets/js/diaporama_slideshow.js"></script>

<!-- filepath: /var/www/html/TAWSSIL-DZ/View/partials/diaporama.php -->
<figure id="diaporama" class="diaporama fixed-height">
    <ul id="slide" class="diaporama-slide">
        <?php foreach ($slides as $k => $slide): ?>
            <?php
            $isInternal = strpos($slide['ImageLink'], 'http') === false;
            $imageSrc = $isInternal 
                ? APP_URL . "/?view=HomePage&action=viewImage&link=" . rawurlencode($slide['ImageLink']) 
                : $slide['ImageLink'];
            ?>
            <li class="diaporama-item">
                <a href="<?= htmlspecialchars($slide['SlideLink']) ?>" target="_blank" rel="noopener noreferrer">
                    <img src="<?= htmlspecialchars($imageSrc) ?>" alt="diapo_<?= $k ?>" class="diaporama-image">
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <button id="prev" class="diaporama-button diaporama-button-prev">&lt;</button>
    <button id="next" class="diaporama-button diaporama-button-next">&gt;</button>
</figure>