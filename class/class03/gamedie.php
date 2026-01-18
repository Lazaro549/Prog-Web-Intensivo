<?php
class GameDie {
    private $sides;
    private $value;
    
    public function __construct($sides = 6) {
        $this->sides = $sides;
        $this->roll();
    }
    
    public function roll() {
        $this->value = rand(1, $this->sides);
        return $this->value;
    }
    
    public function getValue() {
        return $this->value;
    }
}
?>