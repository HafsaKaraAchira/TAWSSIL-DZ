<header>
    <a href='/?view=HomePage'><img src='<?= asset('Assets/img/logo.svg') ?>' alt='logo'></a>
    <h1>VTC Transport de matériels et colis</h1>
    <div>
        <button id='inscription' onclick='window.location="/?view=Inscription"'>Inscription</button>
        <button id='connexion' onclick='window.location="/?view=Login"'>Connexion</button>
        <button id='profile' class='<?= $this->username ?>' onclick='window.location="/?view=Profile"'
            style='display:none;'>Profile</button>
        <button id='deconnecter' onclick='window.location="/?action=Deconnecter&view=Login"'
            style='display:none;'>Deconnecter</button>
    </div>
</header>