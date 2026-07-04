<?php

namespace Tests\Feature;

use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a donation.
     */
    public function test_can_create_donation(): void
    {
        $response = $this->postJson('/api/donations', [
            'nom' => 'Alain Mukendi',
            'montant' => 150.50,
            'message' => 'Soutien aux étudiants de Goma',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'id',
                    'nom',
                    'montant',
                    'message',
                    'date_don',
                    'created_at',
                    'updated_at',
                ]
            ]);

        $this->assertDatabaseHas('donations', [
            'nom' => 'Alain Mukendi',
            'montant' => 150.50,
            'message' => 'Soutien aux étudiants de Goma',
        ]);
    }

    /**
     * Test validation.
     */
    public function test_validation_prevents_invalid_donations(): void
    {
        $response = $this->postJson('/api/donations', [
            'nom' => '',
            'montant' => -10,
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'success',
                'message',
                'errors' => [
                    'nom',
                    'montant',
                ]
            ]);
    }

    /**
     * Test listing and sum.
     */
    public function test_can_list_donations_and_calculate_total(): void
    {
        Donation::create(['nom' => 'Donateur A', 'montant' => 100.00, 'date_don' => now()]);
        Donation::create(['nom' => 'Donateur B', 'montant' => 250.50, 'date_don' => now()]);

        $response = $this->getJson('/api/donations');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'total' => 350.50,
                'count' => 2,
            ]);
    }

    /**
     * Test filtering.
     */
    public function test_can_filter_donations_by_date(): void
    {
        Donation::create(['nom' => 'Old Don', 'montant' => 50.00, 'date_don' => '2026-01-01 10:00:00']);
        Donation::create(['nom' => 'New Don', 'montant' => 75.00, 'date_don' => '2026-07-04 12:00:00']);

        // Filter for July
        $response = $this->getJson('/api/donations?start_date=2026-07-01&end_date=2026-07-05');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['nom' => 'New Don'])
            ->assertJsonMissing(['nom' => 'Old Don'])
            ->assertJson(['total' => 75.00]);
    }

    /**
     * Test show endpoint.
     */
    public function test_can_show_donation(): void
    {
        $donation = Donation::create([
            'nom' => 'Donateur Show',
            'montant' => 99.99,
            'message' => 'Show me',
            'date_don' => now()
        ]);

        $response = $this->getJson('/api/donations/' . $donation->id);

        $response->assertStatus(200)
            ->assertJsonPath('data.nom', 'Donateur Show');
    }

    /**
     * Test delete endpoint.
     */
    public function test_can_delete_donation(): void
    {
        $donation = Donation::create([
            'nom' => 'Donateur Delete',
            'montant' => 20.00,
            'date_don' => now()
        ]);

        $response = $this->deleteJson('/api/donations/' . $donation->id);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('donations', [
            'id' => $donation->id
        ]);
    }
}
