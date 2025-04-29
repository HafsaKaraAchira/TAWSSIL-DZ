<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
  // isolate jQuery
  let jq2 = jQuery.noConflict(true);

  jq2(document).ready(function() {
    populate_trajet();
    populate_intervalles();

    // update range outputs
    jq2('input[type=range]').on('input', function() {
      jq2(this).next('output').val(jq2(this).val());
    });

    // if user logged in, attach profile ID and validate add-annonce form
    <?php if (!empty($_SESSION['profile'])): ?>
      jq2('form[name=addannonce]').on('submit', function() {
        jq2(this).append(
          '<input type="hidden" name="profile" value="<?= $_SESSION['profile']['ProfileID'] ?>">'
        );
      });
      jq2('form[name=addannonce]').validate({
        rules: {
          depart: { required: true },
          arriv:  { required: true },
          type:   { required: true },
          poids:  { required: true },
          volume: { required: true },
          moyen:  { required: true }
        },
        messages: {
          depart: 'Ce champ est obligatoire',
          arriv:  'Ce champ est obligatoire',
          type:   'Ce champ est obligatoire',
          poids:  'Ce champ est obligatoire',
          volume: 'Ce champ est obligatoire',
          moyen:  'Ce champ est obligatoire'
        }
      });
    <?php endif; ?>

    // always validate search form
    jq2('form[name=searchbar]').validate({
      rules: {
        depart: { required: true },
        arriv:  { required: true }
      },
      messages: {
        depart: 'Ce champ est obligatoire',
        arriv:  'Ce champ est obligatoire'
      }
    });
  });

  function populate_trajet() {
    let wilayas = [
      'ADRAR','CHLEF','LAGHOUAT','OUM BOUAGHI','BATNA','BEJAIA','BISKRA','BECHAR',
      'BLIDA','BOUIRA','TAMANRASSET','TEBESSA','TLEMCEN','TIARET','TIZI-OUZOU',
      'ALGER','DJELFA','JIJEL','SETIF','SAIDA','SKIKDA','SIDIBELABBES','ANNABA',
      'GUELMA','CONSTANTINE','MEDEA','MOSTAGANEM','MSILA','MASCARA','OUARGLA',
      'ORAN','EL BAYDH','ILLIZI','BORDJ','BOUMERDES','EL TAREF','TINDOUF',
      'TISSEMSILT','EL OUED','KHENCHLA','SOUK AHRASS','TIPAZA','MILA',
      'AÏN DEFLA','NÂAMA','AÏN TEMOUCHENT','GHARDAÏA','RELIZANE'
    ];
    jq2.each(wilayas, function(i, w) {
      jq2('select[name=arriv], select[name=depart]')
        .append(jq2('<option>', { value: w, text: w }));
    });
  }

  function populate_intervalles() {
    let poidsData  = <?= json_encode($_SESSION['configuration']['poids'] ?? []) ?>;
    let volumeData = <?= json_encode($_SESSION['configuration']['volume'] ?? []) ?>;

    jq2.each(poidsData, function(i, p) {
      let text = (p.IntervalleStart >= 1 
        ? p.IntervalleStart + ' kg' 
        : p.IntervalleStart * 1000 + ' g')
        + ' – ' +
        (p.IntervalleEnd > 1
          ? p.IntervalleEnd + ' kg'
          : p.IntervalleEnd * 1000 + ' g');
      jq2('select[name=poids]')
        .append(jq2('<option>', { value: p.PoidsIntervalleID, text: text }));
    });

    jq2.each(volumeData, function(i, v) {
      let text = (v.IntervalleStart >= 1 
        ? v.IntervalleStart + ' m³' 
        : v.IntervalleStart * 1000 + ' cm³')
        + ' – ' +
        (v.IntervalleEnd > 1
          ? v.IntervalleEnd + ' m³'
          : v.IntervalleEnd * 1000 + ' cm³');
      jq2('select[name=volume]')
        .append(jq2('<option>', { value: v.VolumeIntervalleID, text: text }));
    });
  }
</script>
