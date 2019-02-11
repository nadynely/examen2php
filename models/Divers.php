<?php


class Divers extends Db {

// Afficher le nombre de conducteurs.
    public static function nombreConducteurs() {
        $req = 'SELECT COUNT(*)
                FROM conducteur';
        return Db::dbQuery($req);
    }

    // Afficher le nombre de véhicules.
    public static function nombreVehicules() {
        $req = 'SELECT COUNT(*)
                FROM vehicule';
        return Db::dbQuery($req);
    }

    // Afficher le nombre d'associations.
    public static function nombreAssociations() {
        $req = 'SELECT COUNT(*)
                FROM association_vehicule_conducteur';
        return Db::dbQuery($req);
    }

    // Afficher les véhicules n'ayant pas de conducteurs.
    public static function vehiculesSansConducteurs() {
        $req = 'SELECT *
                FROM vehicule
                LEFT JOIN association_vehicule_conducteur ON association_vehicule_conducteur.id_vehicule = vehicule.id
                WHERE id_conducteur IS NULL';
        return Db::dbQuery($req);
    }

    // Afficher les conducteurs n'ayant pas de véhicules.
    public static function conducteursSansVehicules() {
        $req = 'SELECT *
                FROM conducteur
                LEFT JOIN association_vehicule_conducteur ON association_vehicule_conducteur.id_conducteur = conducteur.id
                WHERE id_vehicule IS NULL';
        return Db::dbQuery($req);
    }
    
}