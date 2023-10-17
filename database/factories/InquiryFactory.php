<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Inquiry;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{

    protected $model = Inquiry::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'company_name' => $this->faker->company(),
            'requirements' => $this->faker->text(),
            'budget' => $this->faker->randomElement([
                'One-Time Project (Not Monthly)',
                'INR 50000 to INR 1 Lakh Per Month',
                'INR 1 Lac to INR 2 Lacs Per Month',
                'INR 2 Lacs to INR 5 Lacs Per Month',
                'Above INR 5 lacs per month'
            ]),
            'handled_by' => '1',
            'L1' => $this->faker->randomElement([
                'Done',
                'Not Done'
            ]),
            'L1_minutes' => $this->faker->paragraph(),
            'brief' => $this->faker->randomElement([
                'Done',
                'Not Done'
            ]),
            'brief_details' => $this->faker->paragraph(),
            'commercial' => '0',
            'lead_status' => $this->faker->randomElement([
                'Oppurtunity',
                'Qualified Lead',
                'New Lead',
                'AWOL',
                'Converted',
                "Don't Want",
                'Lost'
            ]),
            'lead_source' => $this->faker->randomElement([
                'Website',
                'Referral',
                'Social Media',
                'Others'
            ]),
            'first_contacted' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'last_client_contacted' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'last_contacted' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'remarks' => $this->faker->paragraph(),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
