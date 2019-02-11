<?php

class Vehicule extends Db {
    
    protected $id;
    protected $marque;
    protected $modele;
    protected $couleur;
    protected $immatriculation;

    const TABLE_NAME = "vehicule";

    public function __construct($marque, $modele, $couleur, $immatriculation, $id = null)
    {
        $this->setMarque($marque);
        $this->setModele($modele);
        $this->setCouleur($couleur);
        $this->setImmatriculation($immatriculation);
        $this->setId($id);
    }

    /**
     * Get the value of id
     */ 
    public function id()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

   /**
     * Get the value of marque
     */ 
    public function marque()
    {
        return $this->marque;
    }

    /**
    * Set the value of marque
     *
     * @return  self
         */ 
    public function setMarque($marque)
    {
        if (strlen($marque) == 0) {
            throw new Exception('La marque du véhicule doit être indiquée.');
        }

        $this->marque = $marque;

        return $this;
    }

    /**
     * Get the value of modele
     */ 
    public function modele()
    {
        return $this->modele;
    }

    /**
     * Set the value of modele
     *
     * @return  self
     */ 
    public function setModele($modele)
    {
        if (strlen($modele) == 0) {
            throw new Exception('Le modèle du véhicule doit être indiqué.');
        }

        $this->modele = $modele;

        return $this;
    }
    
    /**
     * Get the value of couleur
     */ 
    public function couleur()
    {
        return $this->couleur;
    }

    /**
     * Set the value of couleur
     *
     * @return  self
     */ 
    public function setCouleur($couleur)
    {
         if (strlen($couleur) == 0) {
            throw new Exception('La couleur du véhicule doit être indiquée.');
        }

        $this->couleur = $couleur;

        return $this;
    }
    
    /**
     * Get the value of immatriculation
     */ 
    public function immatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * Set the value of immatriculation
     *
     * @return  self
     */ 
    public function setImmatriculation($immatriculation)
    {
         if (strlen($immatriculation) == 0) {
            throw new Exception('L\'immatriculation du véhicule doit être indiquée.');
        }

        $this->immatriculation = $immatriculation;

        return $this;
    }    


    /**
     * Méthodes CRUD :
     * - find
     * - findAll
     * - findOne
     * - save
     * - update
     * - delete
     */

    public function save() {

        $data = [
            "marque"          => $this->marque(),
            "modele"          => $this->modele(),
            "couleur"         => $this->couleur(),
            "immatriculation" => $this->immatriculation()
        ];

        if ($this->id > 0) return $this->update();

        $nouvelId = Db::dbCreate(self::TABLE_NAME, $data);

        $this->setId($nouvelId);

        return $this;
    }

    public function update() {

        if ($this->id > 0) {

            $data = [
            "marque"          => $this->marque(),
            "modele"          => $this->modele(),
            "couleur"         => $this->couleur(),
            "immatriculation" => $this->immatriculation(),
            "id"              => $this->id()
            ];

            Db::dbUpdate(self::TABLE_NAME, $data, 'id_vehicule');

            return $this;
        }

        return;
    }

    public function delete() {
        $data = [
            'id' => $this->id(),
        ];
        
        Db::dbDelete(self::TABLE_NAME, $data);

        // On supprime aussi toutes les réservations VTC
        Db::dbDelete('association_vehicule_conducteur', [
            'id_vehicule' => $this->id()
        ]);

        return;
    }

    public static function findAll($objects = true) {

        $data = Db::dbFind(self::TABLE_NAME);
        
        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {

                $objectsList[] = new Vehicule($d['marque'], $d['modele'], $d['couleur'], $d['immatriculation'], intval($d['id']));
            }

            return $objectsList;
        }

        return $data;
    }

    public static function find(array $request, $objects = true) {

        $data = Db::dbFind(self::TABLE_NAME, $request);

        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {
                $objectsList[] = new Vehicule($d['marque'], $d['modele'], $d['couleur'], $d['immatriculation'], intval($d['id']));

            }

            return $objectsList;
        }

        return $data;
    }

    public static function findOne(int $id, $object = true) {

        $request = [
            ['id', '=', $id]
        ];

        $data = Db::dbFind(self::TABLE_NAME, $request);

        if (count($data) > 0) $data = $data[0];
        else return;

        if ($object) {
            $vehicule = new Vehicule($d['marque'], $d['modele'], $d['couleur'], $d['immatriculation'], intval($d['id']));
            return $vehicule;
        }

        return $data;
    }


        

       

        
}