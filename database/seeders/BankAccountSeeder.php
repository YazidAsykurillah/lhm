<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BankAccount;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bank1 = BankAccount::updateOrCreate(
            [
                'name'=>'Bank Mandiri',
            ],
            [
                'name'=>'Bank Mandiri',
                'account_number'=>'12345',
                'status'=>'inactive'
            ],
        );

        $bank2 = BankAccount::updateOrCreate(
            [
                'name'=>'Bank BCA',
            ],
            [
                'name'=>'Bank BCA',
                'account_number'=>'123456',
                'status'=>'inactive'
            ],
        );

        $bank3 = BankAccount::updateOrCreate(
            [
                'name'=>'Bank BNI',
            ],
            [
                'name'=>'Bank BNI',
                'account_number'=>'1234567',
                'status'=>'inactive'
            ],
        );

        $bank4 = BankAccount::updateOrCreate(
            [
                'name'=>'Bank BCA Syariah',
            ],
            [
                'name'=>'Bank BCA Syariah',
                'account_number'=>'12345678',
                'status'=>'active'
            ],
        );

        $bank5 = BankAccount::updateOrCreate(
            [
                'name'=>'Bank BSI Syariah',
            ],
            [
                'name'=>'Bank BSI Syariah',
                'account_number'=>'123456789',
                'status'=>'active'
            ],
        );

    }
}
