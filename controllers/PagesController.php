<?php

class PagesController {

    public function home() {

        view('pages.home');

    }

    public function divers() {

        echo "<hr>Afficher le nombre de conducteurs.";
        var_dump(Divers::nombreConducteurs());

        echo "<hr>Afficher le nombre de véhicules.";
        var_dump(Divers::nombreVehicules());

        echo "<hr>Afficher le nombre d'associations.";
        var_dump(Divers::nombreAssociations());

        echo "<hr>Afficher les véhicules n'ayant pas de conducteurs.";
        var_dump(Divers::vehiculesSansConducteurs());

        echo "<hr>Afficher les conducteurs n'ayant pas de véhicules.";
        var_dump(Divers::conducteursSansVehicules());
    }

}