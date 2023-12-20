<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\users;
use App\Models\Program;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = \App\Models\Department::all();
        $randomIndex = $this->faker->numberBetween($min = 1, $max = ($departments->count() - 1));
        $finalManHours = "";

        $budget = ($this->faker->numberBetween($min = 5, $max = 100) * 1000);
        if ($budget >= 0 && $budget < 10000) {
            $categoryBudget = 'Laag';
        } else if ($budget >= 10000 && $budget < 50000) {
            $categoryBudget = 'Middel';
        } else {
            $categoryBudget = 'Hoog';
        }


        $departmentNames = [];
        for ($i = 0; $i < $randomIndex; $i++) {
            $randomDepartment = \App\Models\Department::all()->random();
            
            while (in_array($randomDepartment->name, $departmentNames)) {
                $randomDepartment = \App\Models\Department::all()->random();
            }
            $departmentNames[] = $randomDepartment->name;

            $department = $randomDepartment->name;
            $manHours = $this->faker->numberBetween($min = 100, $max = 2000);

            if (strlen($finalManHours) > 0) {
                $finalManHours .= ";";
            }

            if ($manHours >= 0 && $manHours < 500) {
                $categoryManHours = 'Laag';
            } else if ($manHours >= 500 && $manHours < 1000) {
                $categoryManHours = 'Middel';
            } else {
                $categoryManHours = 'Hoog';
            }
            $finalManHours .= ($department . ':' . $manHours . ':' . $categoryManHours);
        }

        return [
            'name' => $this->getFictitiousProjectName(),
            'code' => $this->faker->bothify('##??#?'),
            'description' => $this->getFictitiousProjectDescription(),
            'department' => \App\Models\Department::all()->random()->name,
            'department_man_hours' => $finalManHours,
            'budget' => $budget,
            'category_budget' => $categoryBudget,
            'spent_costs' => $this->faker->numberBetween($min = 1000, $max = 7999),

            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,

            'projectleader' => users::all()->random()->name,
            'second_projectleader' => users::all()->random()->name,
            'initiator' => users::all()->random()->name,
            'actor' => users::all()->random()->name,

            'reasoning' => $this->getFictitiousProjectReasoning(),
            'uploaded_document_start' => $this->faker->optional()->text, // Assuming binary data is stored as text
            'uploaded_document_planning' => $this->faker->optional()->text, // Assuming binary data is stored as text
            'program' => Program::all()->random()->name,
            'community_link' => $this->faker->url,
            'project_status' => $this->faker->randomElement($array = array ('Op schema','Vertraagd','Afgewezen')),
            'progress' => $this->faker->numberBetween($min = 20, $max = 100),
            'check_discussion_RvB' => $this->faker->boolean,
        ];
    }

    private function getFictitiousProjectName(): string
{
    static $counter = 0;

    $projectNames = [
        "Welzijnsbevordering in de Gemeenschap",
        "Veerkacht in Herstelprogramma",
        "Initiatief voor Virtuele Therapeutische Ruimtes",
        "Geïntegreerd Toegankelijk Netwerk voor Geestelijke Gezondheidszorg",
        "Empower360 Campagne voor Mentale Welzijn",
        "Project Mindfulle Toekomst",
        "Alliantie voor Ondersteuning door Lotgenoten",
        "TeleZorg Verbinding: Oplossingen voor Zorg op Afstand",
        "Gezonde Geesten Werkplek Programma",
        "Jeugdige Weerbaarheidsopbouwers",
        "Pilot Mindfulness in Onderwijs",
        "Programma voor Navigatie van Familiewelzijn",
        "Hub voor Creatieve Therapieën",
        "Digitaal Centrum voor Geestelijke Gezondheid Hulpbronnen",
        "Initiatief voor Gemeenschapsveerkrachtopbouw",
        "Uitbreiding van Traumageïnformeerde Zorg",
        "Project voor Welzijn en Verbinding bij Ouderen",
        "Initiatief voor Mindful Ouderschap",
        "Taskforce voor Crisisrespons en Herstel",
        "Holistic Gezondheidsnavigatiesysteem",
    ];

    $index = $counter % count($projectNames);
    $counter++;

    return $projectNames[$index];
}

private function getFictitiousProjectDescription(): string
{
    static $counter = 0;

    $projectDescriptions = [
        "Verbetering van de gemeenschapsgezondheid door outreach-programma's en preventie-initiatieven.",
        "Herstelprogramma gericht op veerkrachtopbouw en emotioneel welzijn.",
        "Gebruik van virtuele ruimtes voor therapeutische behandelingen en ondersteuning.",
        "Een toegankelijk netwerk voor geestelijke gezondheidszorgintegratie in verschillende disciplines.",
        "Campagne gericht op empowerment en bewustwording van mentaal welzijn.",
        "Een project dat zich richt op mindfulness en welzijn in de toekomst.",
        "Ondersteuningsalliantie die peers helpt elkaar te ondersteunen in hun herstelreis.",
        "Oplossingen voor zorg op afstand om toegankelijkheid te vergroten.",
        "Initiatieven gericht op het bevorderen van gezonde geesten op de werkplek.",
        "Programma voor het opbouwen van veerkracht bij jongeren en adolescenten.",
        "Mindfulness in het onderwijs integreren om emotionele gezondheid te bevorderen.",
        "Ondersteuningsprogramma voor families om hen te helpen bij het bevorderen van welzijn.",
        "Creatieve therapieën gebruiken voor het bevorderen van herstel en expressie.",
        "Digitaal platform voor toegang tot geestelijke gezondheidsbronnen en ondersteuning.",
        "Opbouw van veerkracht binnen gemeenschappen voor langdurige welzijnsverbetering.",
        "Uitbreiding van zorg die rekening houdt met traumatische ervaringen voor betere ondersteuning.",
        "Welzijnsprogramma gericht op het verbinden van ouderen en bevordering van hun welzijn.",
        "Initiatief om ouders te ondersteunen bij het ontwikkelen van mindful opvoedvaardigheden.",
        "Taskforce die gericht is op crisisrespons en het bevorderen van herstel in gemeenschappen.",
        "Geïntegreerd systeem voor gezondheidsnavigatie met focus op holistische zorgbenadering.",
    ];

    $index = $counter % count($projectDescriptions);
    $counter++;

    return $projectDescriptions[$index];
}

private function getFictitiousProjectReasoning(): string
{
    static $counter = 0;

    $projectReasonings = [
        "Het vergroten van preventieve zorginitiatieven zal de algehele gemeenschapsgezondheid verbeteren.",
        "Het aanpakken van veerkrachtopbouw draagt bij aan een gezondere en sterkere gemeenschap.",
        "Toegang tot online therapie en virtuele ondersteuning zal de zorgtoegankelijkheid vergroten.",
        "Een geïntegreerd zorgnetwerk zal efficiëntere diensten en betere zorgcoördinatie bieden.",
        "Bewustwordingscampagnes helpen bij het verminderen van het stigma rond geestelijke gezondheid.",
        "Investeren in mindfulness en toekomstige welzijnsbenaderingen creëert robuustere ondersteuning.",
        "Peer-supportsystemen stimuleren zelfredzaamheid en bieden essentiële ondersteuning.",
        "Afstandszorgoplossingen vergroten de toegankelijkheid voor afgelegen gemeenschappen.",
        "Gezonde geesten op de werkplek bevorderen productiviteit en welzijn van werknemers.",
        "Het versterken van veerkracht bij jongeren leidt tot gezondere toekomstige generaties.",
        "Mindfulness in het onderwijs helpt bij het ontwikkelen van emotionele intelligentie bij jongeren.",
        "Ondersteuning van families draagt bij aan een ondersteunende thuisomgeving voor beter herstel.",
        "Creatieve therapieën bieden een expressieve uitlaatklep voor individuele verwerking.",
        "Digitale toegang tot bronnen bevordert laagdrempelige ondersteuning voor iedereen.",
        "Gemeenschapsgerichte veerkracht bouwt een samenhangend ondersteuningssysteem op.",
        "Het aanbieden van traumageïnformeerde zorg verbetert de kwaliteit van de behandeling.",
        "Verbinding onder ouderen draagt bij aan een gevoel van gemeenschap en steun.",
        "Ondersteuning van ouders met mindfulness bevordert gezinswelzijn en harmonie.",
        "Snelle crisisresponsmechanismen bevorderen veerkracht en snel herstel.",
        "Een holistische benadering verbetert de algehele gezondheid door integratie van zorgaspecten.",
    ];

    $index = $counter % count($projectReasonings);
    $counter++;

    return $projectReasonings[$index];
}

}

