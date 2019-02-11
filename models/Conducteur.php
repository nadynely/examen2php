<?php

class Conducteur extends Db {
    
    protected $id;
    protected $prenom;
    protected $nom;

    const TABLE_NAME = "conducteur";


    public function __construct($prenom, $nom, $id = null)
    {
        $this->setPrenom($prenom);
        $this->setNom($nom);
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
     * Get the value of prenom
     */ 
    public function prenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        if (strlen($prenom) == 0) {
            throw new Exception('Le prénom doit être indiqué.');
        }

        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function nom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        if (strlen($nom) == 0) {
            throw new Exception('Le nom doit être indiqué.');
        }

        $this->nom = $nom;

        return $this;
    }

    public function prenomNom() {
        return $this->prenom . ' ' . $this->nom;
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
            "prenom"       => $this->prenom(),
            "nom"          => $this->nom(),
            
        ];


        if ($this->id() > 0) return $this->update();

        $nouvelId = Db::dbCreate(self::TABLE_NAME, $data);

        $this->setId($nouvelId);

        return $this;
    }

    public function update() {

        if ($this->id > 0) {

            $data = [
                "prenom"    => $this->prenom(),
                "nom"       => $this->nom(),
                "id"        => $this->id()
            ];

            Db::dbUpdate(self::TABLE_NAME, $data, 'id_conducteur');

            return $this;
        }

        return;
    }

    public function delete() {
        $data = [
            'id' => $this->id(),
        ];
        
        Db::dbDelete(self::TABLE_NAME, $data);

        // On supprime aussi toutes les réservations de VTC
        Db::dbDelete('association_vehicule_conducteur', [
            'id_conducteur' => $this->id()
        ]);

        return;
    }

    public static function findAll($objects = true) {

        $data = Db::dbFind(self::TABLE_NAME);
        
        if ($objects) {
            $objectsList = [];

            foreach ($data as $d) {

                $objectsList[] = new Conducteur($d['prenom'], $d['nom'], intval($d['id']));
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
                $objectsList[] = new Conducteur($d['prenom'], $d['nom'], intval($d['id']));

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
            $conducteur = new Conducteur($data['prenom'], $data['nom'], intval($data['id']));
            return $conducteur;
        }

        return $data;
    }
}