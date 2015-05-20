<?php

namespace Message\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Message {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /** @ORM\Column(type="integer") */
    private $userId = 0;

    /** @ORM\Column(type="string") */
    private $currencyFrom;

    /** @ORM\Column(type="string") */
    private $currencyTo = '';
    
    /** @ORM\Column(type="float") */
    private $amountSell = '';
    
    /** @ORM\Column(type="float") */
    private $amountBuy = '';
    
    /** @ORM\Column(type="float") */
    private $rate = '';
    
    /** @ORM\Column(type="datetime") */
    private $timePlaced = '';
    
    /** @ORM\Column(type="string") */
    private $originatingCountry = '';
    

    public function __construct() {}

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($val) {
        $this->userId = $val;
    }
    
    public function setCurrencyFrom($val) {
        $this->currencyFrom = $val;
    }
    
    public function setCurrencyTo($val) {
    	$this->currencyTo = $val;
    }
    
    public function setAmountSell($val) {
    	$this->amountSell = $val;
    }
    
    public function setAmountBuy($val) {
    	$this->amountBuy = $val;
    }
    
    public function setRate($val) {
    	$this->rate = $val;
    }
    
    public function setTimePlaced($val) {
    	$this->timePlaced = $val;
    }
    
    public function setOriginatingCountry($val) {
    	$this->originatingCountry = $val;
    }
    

    public function toArray() {
        return get_object_vars($this);
    }
}
