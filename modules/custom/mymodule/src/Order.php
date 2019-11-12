<?php 

namespace Drupal\mymodule;

class Order {
    
    public $amount = 0;
    protected $paymentGateway; 

    public function __construct(PaymentGateway $paymentGateway) {
        $this->paymentGateway = $paymentGateway;
    }

    public function process() {
        return $this->paymentGateway->charge($this->amount);
    }
    
}