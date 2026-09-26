<?php

declare(strict_types=1);

class Transaction
{

    public function __construct(
        private string $id,
        private string $type,
        private float $amount
    ){

    }

    public function process(): bool
    {

        if(session_status() === PHP_SESSION_NONE){

            session_start();

        }


        if(!isset($_SESSION['balance'])){

            $_SESSION['balance'] = 0;

        }


        $result = match($this->type){

            "deposit" => function(){

                $_SESSION['balance'] += $this->amount;

                return true;

            },

            "withdraw" => function(){

                if($_SESSION['balance'] < $this->amount){

                    return false;

                }

                $_SESSION['balance'] -= $this->amount;

                return true;

            },

            default => false

        };

        return $result();
    }

}   