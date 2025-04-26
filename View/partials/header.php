<header class="header">
    <a href="/?view=HomePage" class="header-logo">
        <img src="<?= asset('Assets/img/logo.svg') ?>" alt="logo" class="header-logo-img">
        <span class="header-logo-text">TAWSSIL DZ</span>
    </a>
    <h1 class="header-title">Transport de matériels et colis</h1>
    <div class="header-buttons">
        <button id="inscription" onclick="window.location='/?view=Inscription'" class="btn-primary">Inscription</button>
        <button id="connexion" onclick="window.location='/?view=Login'" class="btn-secondary">Connexion</button>
        <button id="profile" class="<?= $this->username ?> hidden btn-primary" onclick="window.location='/?view=Profile'">Profile</button>
        <button id="deconnecter" class="hidden btn-secondary" onclick="window.location='/?action=Deconnecter&view=Login'">Deconnecter</button>
    </div>
</header>