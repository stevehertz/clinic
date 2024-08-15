<?php 

namespace App\Repositories;

use App\Models\Banking;

class BankingRepository
{
    public function getAllBanking()  
    {
        return Banking::with(['insurance'])->latest()->get();
    }
}