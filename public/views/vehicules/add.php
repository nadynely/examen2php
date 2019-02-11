<?php ob_start(); ?>



<form action="<?= url('vehicules/save') ?>" method="post">

    <input type="hidden" name="id"              value="<?= (isset($vehicule)) ? $vehicule->id() : '' ?>">
    <input type="text"   name="marque"          value="<?= (isset($vehicule)) ? $vehicule->marque() : '' ?>"    placeholder="Marque"  class="form-control">
    <input type="text"   name="modele"          value="<?= (isset($vehicule)) ? $vehicule->modele() : '' ?>"   placeholder="Modèle" class="form-control">
    <input type="text"   name="couleur"         value="<?= (isset($vehicule)) ? $vehicule->couleur() : '' ?>"    placeholder="Couleur"  class="form-control">
    <input type="text"   name="imatriculation"  value="<?= (isset($vehicule)) ? $vehicule->imatriculation() : '' ?>"   placeholder="Immatriculation" class="form-control">

    <button type="submit" class="btn btn-<?= (isset($vehicule)) ? 'warning' : 'success' ?>">
        <?= (isset($vehicule)) ? 'Editer' : 'Ajouter' ?> ce véhicule
    </button>
</form>

<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>
