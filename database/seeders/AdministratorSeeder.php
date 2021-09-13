<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->email = "zeronine09@gmail.com";
        $administrator->password = \Hash::make("hadidfajar09");
        $administrator->name = "Zero Nine";
        $administrator->fungsi = "admin";
        $administrator->kelamin = "pria";
        $administrator->picture = "none.png";
        $administrator->alamat = "Tabaria FajarNet";
        $administrator->nomer = "085796124090";
        $administrator->save();
        $this->command->info("ZeroNine Admin berhasil diinsert");
    }
}
