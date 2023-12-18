<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->getFictitiousProgram(),
            'description' => $this->getFictitiousProgramDescription(),
            'portfolio_holder' => User::all()->random()->name,
        ];
    }

    private function getFictitiousProgram(): string
{
    static $counter = 0;

    $programs = [
        "Geestelijke Gezondheidszorg voor Gemeenschappen",
        "Veerkacht en Herstelinitiatieven",
        "Digitale Gezondheidsoplossingen",
        "Preventieve Gezondheidszorgbevordering",
        "Jongerenwelzijn en Ontwikkelingsprogramma's",
        "Familieondersteuning en Welzijnsbevordering",
        "Creatieve Therapie en Expressieve Behandelprogramma's",
        "Traumageïnformeerde Zorguitbreiding",
        "Ouderenwelzijn en Verbondenheid",
        "Mindfulness en Gezinsgeoriënteerde Zorgbenaderingen",
    ];    

    $index = $counter % count($programs);
    $counter++;

    return $programs[$index];
}

private function getFictitiousProgramDescription(): string
{
    static $counter = 0;

    $programDescriptions = [
        "Programma dat zich richt op het bieden van geestelijke gezondheidszorgdiensten en -ondersteuning aan diverse gemeenschappen.",
        "Initiatieven gericht op het bevorderen van veerkracht en herstel na diverse uitdagingen en traumatische ervaringen.",
        "Ontwikkeling en implementatie van digitale oplossingen om de toegang tot gezondheidszorg te verbeteren en te innoveren.",
        "Programma dat zich richt op preventieve maatregelen om gezondheidsproblemen te voorkomen en te verminderen.",
        "Initiatieven gericht op het verbeteren van het welzijn en de ontwikkeling van jongeren door middel van diverse programma's.",
        "Ondersteuningsprogramma's die gericht zijn op het bieden van hulp en welzijnsondersteuning aan families in verschillende situaties.",
        "Programma dat creatieve therapieën en expressieve benaderingen gebruikt om herstel en behandeling te bevorderen.",
        "Uitbreiding van zorg met aandacht voor traumatische ervaringen om betere ondersteuning te bieden aan hen die dit nodig hebben.",
        "Initiatieven en programma's die zich richten op het welzijn, de verbondenheid en de ondersteuning van ouderen in de samenleving.",
        "Gezinsgerichte zorgbenaderingen en mindfulnessprogramma's die het welzijn van gezinnen centraal stellen.",
    ];
     

    $index = $counter % count($programDescriptions);
    $counter++;

    return $programDescriptions[$index];
}
}
