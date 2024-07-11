<?php

    class Status {

        static function pegarStatus($statusId) {
            if ($statusId == 1) {
                return 'Fazer';
            } else if ($statusId == 2) {
                return 'Fazendo';
            } else {
                return 'Feito';
            }
        }
        
    }
