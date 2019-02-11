<?php ob_start(); ?>

<table class="table table-striped">
    <tr>
        <th>Id_vehicule</th>
        <th>Marque</th>
        <th>Modèle</th>
        <th>Couleur</th>
        <th>Immatriculation</th>
    </tr>

    <?php foreach($vehicules as $vehicule) : ?>
        <tr>
            <td>
                <a href="<?= url('vehicules/' . $vehicule->id())?>">
                    <?= $vehicule->id() ?>
                </a>
            </td>
            <td><?= $vehicule->marque() ?></td>
            <td><?= $vehicule->modele() ?></td>
            <td><?= $vehicule->couleur() ?></td>
            <td><?= $vehicule->immatriculation() ?></td>
            <td>
                <a href="<?= url('vehicules/' . $vehicule->id() . '/edit')?>"><i class="fas fa-pencil-alt"></i></a>
            </td>
            <td>
                <a href="<?= url('vehicules/' . $vehicule->id() . '/delete')?>" class="delete"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php $content = ob_get_clean(); ?>
<?php view('template', compact('content')); ?>