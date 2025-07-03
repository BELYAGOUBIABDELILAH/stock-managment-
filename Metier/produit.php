<?php

include_once "C:xampp\htdocs\Mini\DAO\DAO.php";

class Produit {
    private $reference;
    private $libelle;
    private $prixUni;
    private $quantite;
    private $prixAchat;
    private $image;
    private $cat;
    private $desc;
    private $dao;

    function __construct($r,$l,$p,$q,$a,$i,$c){
        $this->reference = $r;
        $this->libelle = $l;
        $this->prix = $p;
        $this->quantite = $q;
        $this->prixAchat = $a;
        $this->image = $i;
        $this->cat = $c;

        $this->dao = new DAO();
    }

    function get($c){
        switch($c){
            case "r" : return $this->reference;
            case "l" : return $this->libelle;
            case "p" : return $this->prix;
            case "q" : return $this->quantite;
            case "a" : return $this->prixAchat;
            case "i" : return $this->image;
            case "c" : return $this->cat;
            case "d" : return $this->desc;
        }
    }

    function save(){
        $this->dao->ajouterProduit($this);
    }

    static function afficher(){
        $dao = new DAO();
        $cl=$dao->afficherProduits();
        return $cl;
    }

    function update($cli){
        $this->dao->updateProduit($cli);
    }

    static function deleteProduit($cli){
        $dao = new DAO();
        $dao->deleteProduit($cli);
    }

    public static function total(){
        $dao = new DAO();
        return $dao->getProduitTotal();
    }

    public static function afficherTopProduits($n = 3) {
        $dao = new DAO();
        $produits = $dao->afficherProduits();
    
        // Sort products by quantity in descending order
        usort($produits, function($a, $b) {
            return $b->get('q') - $a->get('q');
        });
    
        // Get the top N products
        $topProduits = array_slice($produits, 0, $n);
    
        // Display the top N products with custom CSS
        $i = 1; // Counter for product numbering
        foreach ($topProduits as $produit) {
            echo '<div class="card d-flex flex-row align-items-center" style="width: 80%; background-color: var(--bs-body-bg);margin:1rem 1.5rem;border: 1px var(--bs-body-bg) solid;">';
            echo '<img class="card-img-top" src="../assets/photos/' . $produit->get('i') . '" style="width: 75px; height:110px ;border-radius:0.7rem">';
            echo '<div class="card-body d-flex flex-column" style="padding:0.5rem;">';
            echo '<p class="card-text refer align-self-start" style="font-size: 1.1rem; font-weight:bold;">' . $i . '. ' . $produit->get('l') . '</p>';
            echo '<p class="card-text text-center libel align-self-end" style="font-size: 0.9rem;">' . $produit->get('p') . ' DA</p>';
            echo '<p class="card-text text-center libel align-self-end" style="font-size: 0.9rem;">Quantité disponible: ' . $produit->get('q') . '</p>';
            echo '</div></div>';
            $i++;
        }
    }
    
    
}

?>
