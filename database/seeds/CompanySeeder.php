<?php

use Illuminate\Database\Seeder;
use App\Company;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 250 ; $i++) {
            Company::create(['name' => 'andaglos '.$i,'address' => 'address'.$i,'website' => 'http://url.com'.$i,'email' => 'mail@mail.com'.$i]);
        }
    }
}
