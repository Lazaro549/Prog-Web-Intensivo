<?php
class Pizza {
    public $size;
    public $toppings = [];
    
    public function __construct($size) {
        $this->size = $size;
    }
    
    public function addTopping($topping) {
        $this->toppings[] = $topping;
    }
    
    public function getPrice() {
        $basePrice = $this->size == 'large' ? 15 : ($this->size == 'medium' ? 12 : 8);
        return $basePrice + count($this->toppings) * 2;
    }
}

$pizza = new Pizza('medium');
$pizza->addTopping('pepperoni');
$pizza->addTopping('cheese');
echo "Pizza price: $" . $pizza->getPrice();
?>
