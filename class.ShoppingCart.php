<?php
class ShoppingCart implements Iterator {
    private $position = 0;
    private $array = array();  

    public function __construct() {
        $this->position = 0;
    }
	
    function rewind() {
    	reset($this->array);
	}

	function current() {
		return current($this->array);
	}

	function key() {
		return key($this->array);
	}

	function next() {
		next($this->array);
	}
	function valid() {
		return key($this->array) !== null;
	}
	
	public function addItem($itemnmbr){
		$this->addItemQuantity($itemnmbr,1);
	}
	
	public function updateQuantity($itemnmbr, $newQuantity){
		if($newQuantity <= 0){
			$this->removeItem($itemnmbr);
		}else{
			$this->array[$itemnmbr] = $newQuantity;
		}
	}
	
	public function removeItem($itemnmbr){
		unset($this->array[$itemnmbr]);
	}
	
	public function addItemQuantity($itemnmbr,$quantity){
		if(isset($this->array[$itemnmbr])){
			$this->array[$itemnmbr] += $quantity;
		}else{
			$this->array[$itemnmbr] = $quantity;
		}
	}
	
	public function numItems(){
		return count($this->array);
	}
}
?>