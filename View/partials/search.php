<section class="search-form">
    <!-- Search Form -->
    <div class="search-form-container">
        <form name="searchbar" action="/?view=Recherche&action=Recherche" method="POST" class="search-form-content">
            <h2 class="search-form-title">Recherchez des Offres de Transport en Un Clic</h2>

            <!-- Depart and Arriv Inputs -->
            <div class="search-form-group-vertical">
                <!-- Depart -->
                <div class="search-form-field">
                    <div class="search-form-select-wrapper">
                        <select name="depart" id="depart" class="search-form-select" placeholder="Point de départ">
                            <option value="" disabled selected>Point de départ</option>
                            <?php foreach ($_SESSION['wilayas'] as $wilaya): ?>
                                <option value="<?= $wilaya['WilayaID'] ?>">
                                    <?= $wilaya['WilayaCode'] ?> - <?= $wilaya['WilayaName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="search-form-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <span class="search-form-arrow"></span>
                    </div>
                </div>

                <!-- Reverse Button -->
                <div class="reverse-button-container">
                    <button type="button" id="reverse-button" class="reverse-button">
                        <i class="fas fa-arrows-alt-v"></i>
                    </button>
                </div>

                <!-- Arriv -->
                <div class="search-form-field">
                    <div class="search-form-select-wrapper">
                        <select name="arriv" id="arriv" class="search-form-select" placeholder="Point d'arrivée">
                            <option value="" disabled selected>Point d'arrivée</option>
                            <?php foreach ($_SESSION['wilayas'] as $wilaya): ?>
                                <option value="<?= $wilaya['WilayaID'] ?>">
                                    <?= $wilaya['WilayaCode'] ?> - <?= $wilaya['WilayaName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="search-form-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <span class="search-form-arrow"></span>
                    </div>
                </div>
            </div>

            <!-- Poids -->
            <div class="search-form-field">
                <div class="search-form-select-wrapper">
                    <select name="poids" id="poids" class="search-form-select" placeholder="Poids">
                        <option value="" disabled selected>Poids</option>
                        <?php foreach ($_SESSION['poids'] as $poids): ?>
                            <option value="<?= $poids['PoidsIntervalleID'] ?>">
                                <?= $poids['MinPoids'] ?>kg - <?= $poids['MaxPoids'] ?>kg
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="search-form-icon">
                        <i class="fas fa-weight"></i>
                    </span>
                    <span class="search-form-arrow"></span>
                </div>
            </div>

            <!-- Volume -->
            <div class="search-form-field">
                <div class="search-form-select-wrapper">
                    <select name="volume" id="volume" class="search-form-select" placeholder="Volume">
                        <option value="" disabled selected>Volume</option>
                        <?php foreach ($_SESSION['volumes'] as $volume): ?>
                            <option value="<?= $volume['VolumeIntervalleID'] ?>">
                                <?= $volume['MinVolume'] ?>m³ - <?= $volume['MaxVolume'] ?>m³
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="search-form-icon">
                        <i class="fas fa-box"></i>
                    </span>
                    <span class="search-form-arrow"></span>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="search-form-submit-container">
                <input name="rechbtn" type="submit" value="Rechercher" class="search-form-submit">
            </div>
        </form>
    </div>

    <!-- Map Container -->
    <div id="dz-map" class="map-container relative">
        <!-- Include the SVG file -->
        <div class="dz-map-svg relative" data-map-url="<?= asset('Assets/img/dz.svg') ?>"></div>
    </div>
</section>
