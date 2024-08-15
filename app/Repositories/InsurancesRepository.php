<?php

namespace App\Repositories;

use App\Models\Insurance;

class InsurancesRepository {

    public function getAllInsurance()  
    {
        return Insurance::latest()->get();
    }

}
