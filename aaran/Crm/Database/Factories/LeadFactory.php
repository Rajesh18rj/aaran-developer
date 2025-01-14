<?php

namespace Aaran\Crm\Database\Factories;

use Aaran\Crm\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Aaran\Client\Models\Payment>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;
    public function definition(): array
    {
        return [
            'enquiry_id' => '1',
            'vname' => $this->faker->name,
            'body' => $this->faker->text(200),
            'status_id' => '1',
            'assignee_id' => '1',
            'active_id' => '1',
        ];
    }
}
