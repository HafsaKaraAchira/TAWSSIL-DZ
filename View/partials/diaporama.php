<script src="<?= APP_URL ?>/Assets/js/diaporama_slideshow.js"></script>

<?php if (!empty($slides)): ?>
    <figure id="diaporama" class="diaporama">
        <ul id="slide" class="diaporama-slide">
            <?php foreach ($slides as $k => $slide): ?>
                <?php
                // Determine the image source
                $imageSrc = is_internal_url($slide['ImageLink']) 
                    ? asset("/?view=HomePage&action=viewImage&link=" . rawurlencode($slide['ImageLink'])) 
                    : $slide['ImageLink'];

                // Ensure the slide link has a scheme (http:// or https://) for external URLs
                $linkHref = is_internal_url($slide['SlideLink']) 
                    ? asset($slide['SlideLink']) 
                    : (preg_match('/^https?:\/\//', $slide['SlideLink']) ? $slide['SlideLink'] : 'http://' . $slide['SlideLink']);
                ?>
                <li class="diaporama-item">
                    <a href="<?= htmlspecialchars($linkHref) ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?= htmlspecialchars($imageSrc) ?>" alt="diapo_<?= $k ?>" class="diaporama-image">
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div id="diaporama-dots" class="diaporama-dots">
            <?php foreach ($slides as $k => $slide): ?>
                <button class="diaporama-dot <?= $k === 0 ? 'active' : '' ?>" data-index="<?= $k ?>"></button>
            <?php endforeach; ?>
        </div>
        <button id="prev" class="diaporama-button diaporama-button-prev">&lt;</button>
        <button id="next" class="diaporama-button diaporama-button-next">&gt;</button>
    </figure>
<?php else: ?>
    <p>No slides available.</p>
<?php endif; ?>