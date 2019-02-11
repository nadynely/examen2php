<?php

class Association extends Db {
    
    protected $id;
    protected $idVehicule;
    protected $idConducteur;

    const TABLE_NAME = "association_vehicule_conducteur";

    public function __construct($idVehicule, $idConducteur, $id = null)
    {
        $this->setIdVehicule($idVehicule);
        $this->setIdConducteur($idConducteur);
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
     * Get the value of id_vehicule
     */ 
    public function idVehicule()
    {
        return $this->idVehicule;
    }

    /**
     * Set the value of id_vehicule
     *
     * @return  self
     */ 
    public function setIdVehicule($idVehicule)
    {
        $this->idVehicule = $idVehicule;

        return $this;
    }

    /**
     * Get the value of id_conducteur
     */ 
    public function idConducteur()
    {
        return $this->idConducteur;
    }

    /**
     * Set the value of id_conducteur
     *
     * @return  self
     */ 
    public function setIdConducteur($idConducteur)
    {
        $this->idConducteur = $idConducteur;

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
            "id_vehicule"   => $this->idVehicule(),
            "id_conducteur" => $this->idConducteur()
        ];

        if ($this->id > 0) return $this->update();

        $nouvelId = Db::dbCreate(self::TABLE_NAME, $data);

        $this->setId($nouvelId);

        return $this;
    }

    public function update() {

        if ($this->id > 0) {

            $data = [
            "id_vehicule"   => $this->idVehicule(),
            "id_conducteur" => $this->idConducteur(),
            "id"            => $this->id()
            ];

            Db::dbUpdate(self::TABLE_NAME, $data, 'id_association');

            return $this;
        }

        return;
    }

    public function delete() {
        $data = [
            'id' => $this->id(),
        ];
        
        Db::dbDelete(self::TABLE_NAME, $data);
        return;
    }

    public static function findAll($objects = true) {

        $data = Db::dbFind(self::TABLE_NAME);
        
        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {

                $objectsList[] = new Association($d['id_vehicule'], $d['id_conducteur'], intval($d['id']));
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
                $objectsList[] = new Association($d['id_vehicule'], $d['id_conducteur'], intval($d['id']));

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
            $association = new Association($d['id_vehicule'], $d['id_conducteur'], intval($d['id']));
            return $association;
        }

        return $data;
    }


    public function conducteur() {
        return Conducteur::findOne($this->idConducteur());
    }

    public function vehicule() {
        return Vehicule::findOne($this->idVehicule());
    }


}