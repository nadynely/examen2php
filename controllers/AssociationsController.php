<?php

class AssociationsController {

    public function index() {
        $associations = Association::findAll();
        view('associations.index', compact('associations'));

    }

    public function add() {

        $vehicules   = Vehicule::findAll();
        $conducteurs = Conducteur::findAll();
        view('associations.add', compact('vehicules','conducteurs'));

    }

    public function save() {

        $association = new Association($_POST['id_vehicule'], $_POST['id_conducteur'], $_POST['id']);
        $association->save();

        Header('Location: '. url('associations'));
        exit();

    }


    public function delete($id) {
        $association = Association::findOne($id);
        $association->delete();
        Header('Location: '. url('associations'));
        exit();
    }
}