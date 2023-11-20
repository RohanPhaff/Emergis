<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\roles::create([
            'name' => 'Medewerker',
            'description' => 'Kan projecten inzien waar ze aan toegevoegd zijn',
        ]);
        \App\Models\roles::create([
            'name' => 'Admin',
            'description' => 'Kan projecten aanvragen en alle projecten inzien, aanpassen en verwijderen. Kan gebruikers aanpassen en verwijderen',
        ]);
        \App\Models\roles::create([
            'name' => 'Projectenbureau',
            'description' => 'Kan projecten aanvragen en alle projecten inzien, aanpassen en verwijderen',
        ]);
        \App\Models\roles::create([
            'name' => 'Projectleider',
            'description' => 'Kan projecten aanvragen en al hun eigen projecten inzien, aanpassen en verwijderen',
        ]);
        \App\Models\roles::create([
            'name' => 'Portefeuillehouder',
            'description' => 'Kan projecten aanvragen én, binnen eigen afdeling(en)/programma(s), accepteren en al hun eigen projecten + projecten van hun afdeling(en)/programma(s) inzien, aanpassen en verwijderen',
        ]);
        \App\Models\roles::create([
            'name' => 'RVB',
            'description' => 'Kan projecten aanvragen én accepteren en alle projecten inzien, aanpassen en verwijderen',
        ]);
    }
}
