<section class="p-4">
    <form name="searchbar" action="/?view=Recherche&action=Recherche" method="POST" class="space-y-4">
        <h2 class="text-xl font-bold">Rechercher des annonces</h2>

        <label for="depart">L'emplacement de départ</label>
        <select name="depart" id="depart" class="form-select w-full font-bold">
            <option value="">--Choisir un point de départ--</option>
        </select>

        <label for="arriv">L'emplacement d'arrivée</label>
        <select name="arriv" id="arriv" class="form-select w-full font-bold">
            <option value="">--Choisir un point d'arrivée--</option>
        </select>

        <input name="rechbtn" type="submit" value="Rechercher" class="btn-primary">
    </form>
</section>
