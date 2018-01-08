<?php
//Déclaration des classes du namespace location/DAO
  //namespace location\DAO;              
//classe Bien
        class Bien{
            var $id;
            var $idTypeBien;
            var $idProprietaire;
            var $lastId;
            var $etat;
            var $montantLocation;
            var $nomBien;
            var $commission;
            var $adress;
            var $nomProprietaire;
            var $numPieceProp;
            var $telProp;
            var $base;

            private function getConnexion(){
                try{
                    if($this->base == null){
                        $this->base = new PDO('mysql:host=;dbname=db_Location;charset=utf8', 'root', 'passer',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
                    }       
                }
                catch(Exception $e){
                    die('Erreur : ' . $e->getMessage());
                }
            }
        
            public function addProprietaire(){
                $this->getConnexion();

                $sql = "insert into Proprietaire values(null, :numP, :nom, :tel)";
                $req = $this->base->prepare($sql);
                $donnees = $req->execute(
                    array('numP'=>$this->numPieceProp,
                          'nom'=>$this->nomProprietaire,
                          'tel'=>$this->telProp
                    ));
             }
             public function addBien(){
                $this->getConnexion();
                $sql = "insert into Bien values(null, :nom, :adress, :montantLocation, :commission, :idTypeBien, :idProprietaire)";
                $req = $this->base->prepare($sql);
                $donnees = $req->execute(
                    array('nom'=>$this->nomBien,
                          'adress'=>$this->adress,
                          'montantLocation'=>$this->montantLocation,
                          'commission'=>$this->commission,
                          //'idTypeBien'=>
                          //'idProprietaire'=>
                    )); 
             }
            public function updateBien($id){
                $this->getConnexion();
                $sql = "update Bien set Nom='ok' where id=$this->id";
                $req = $this->base->exec($sql);
            }
            public function findBien($id){
                $this->getConnexion();
                $sql = "select * from Bien where id=$id";
                $req = $this->base->query($sql);
            }
            public function listeBiens(){
                $this->getConnexion();
                $sql = "select * from Bien";
                $biens= $this->base->query($sql);
                return $biens;
            }
            public function listeBiensByType($idTypeBien){
                $this->getConnexion();
                $sql = "select * from Bien b ,typeBien t where b.id=t.id=$idTypeBien";
                $biens= $this->base->query($sql);
                return $biens;
            }
            public function listeBiensByEtat(){
                $this->getConnexion();
                $sql = "select * from Bien where etat = $this->etat";
                $biens= $this->base->query($sql);
                return $biens;
            }
            public function listeProprietaires(){
                $this->getConnexion();
                $sql = "select * from Proprietaire";
                $prop= $this->base->query($sql);
                return $prop;
            }
        }
//class typeBien
        class TypeBien{
            var $id;
            var $nom;
            var $base;
        
            private function getConnexion(){
                try{
                    if($this->base == null){
                        $this->base = new PDO('mysql:host=;dbname=db_Location;charset=utf8', 'root', 'passer',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
                    }       
                }
                catch(Exception $e){
                    die('Erreur : ' . $e->getMessage());
                }
            }

            public function addTypeBien(){
                $this->getConnexion();
                $sql = "insert into typeBien values(null, :nom)";
                $req = $this->base->prepare($sql);
                $donnees = $req->execute(
                    array(
                        'nom'=>$this->nom
                    ));
            }
            public function listeTypesBiens(){
                $this->getConnexion();
                $sql = "select * from typeBien";
                $typesBiens = $this->base->query($sql);
                return $typesBiens;
            }
            public function findTypesBiensById($id){
                $this->getConnexion();
                $sql = "select* from typeBien where id = $id";
            } 
        }
//class utilisateur
       class Utilisateur{
            var $id;
            var $nomComplet;
            var $login;
            var $password;
            var $profil;
            var $etat="inactif";
            var $base;


            private function getConnexion(){
                try{
                    if($this->base == null){
                        $this->base = new PDO('mysql:host=;dbname=db_Location;charset=utf8', 'root', 'passer',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
                    }       
                }
                catch(Exception $e){
                    die('Erreur : ' . $e->getMessage());
                }
            }
            
            public function addUser(){
                $this->getConnexion();
                // requete a executer
                $sql = "insert into utilisateur values(null, :nomComplet, :login, :motDePass, :profil, :etat)";
                $req = $this->base->prepare($sql);
                $donnees = $req->execute(
                    array('nomComplet'=>$this->nomComplet,
                          'login'=>$this->login,
                          'motDePass'=>$this->motDePass,
                          'profil'=>$this->profil,
                          'profiletat'=>$this->etat,
                    )); 
                return $donnees;
                var_dump($data);
            }
            public function activerUser($id){
                $this->getConnexion();
                $sql = "update utilisateur set etat=$this->etat WHERE $id=$this->$id";
                $logs= $this->base->exec($sql);
            }
            public function listeUsers(){
                $this->getConnexion();
                $sql = "select * from utilisateur";
                $users= $this->base->query($sql);
                return $users;
            }
            public function logOn($login,$password){
                $this->getConnexion();
                $sql = "select * from utilisateur where login=$this->login AND password=$this->password";
                $logs= $this->base->query($sql);
                return $logs;
            }
            public function changePassword($id){
                $this->getConnexion();
                $sql = "update utilisateur set password=$this->password WHERE $id=$this->$id";
                $logs= $this->base->exec($sql);
                
            }

        }
        

?>
