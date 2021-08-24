<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;


    public function test_show_login_screen_when_not_authenticated()
    {
        // $this->json('get', "/company")->assertUnauthorized(); //('/login');
        $response = $this->get('/company');
        $response->assertRedirect('/login');
    }

    public function test_the_index_method()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->json('get', '/company')
            ->assertOk()
            ->assertViewIs('pages.company.home')
            ->assertViewHasAll([
                'page_uri' => 'company',
                'companies' => Company::all()
            ]);
    }

    public function test_the_show_method()
    {
        $user = User::factory()->create();
        Company::factory(1)->create();

        $this->actingAs($user)->json('get', '/company/1')
            ->assertOk()
            ->assertJsonPath('response_code', 200)
            ->assertJsonPath('response_data.id', 1)
            ->assertJsonPath('response_message', 'Data query was successfull');
    }

    public function test_the_store_method()
    {
        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($user)
            ->postJson('/company', [
                'name' => 'Vodafone Gh',
                'email' => 'info@vodafonegh.com.gh',
                'website' => 'www.vodafone.com.gh',
                'logo-file' => $file
            ])
            ->assertCreated()
            ->assertJson([
                'response_code' => 201,
                'response_message' => 'Company save successfully'
            ]);
    }

    public function test_the_update_method()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create([
            'name' => 'Vodafone Gh',
            'email' => 'info@vodafonegh.com.gh',
            'website' => 'www.vodafone.com.gh'
        ]);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($user, 'web')
            ->json("post", "/company/" . $company->id, [
                'name' => 'Vodafone Gh',
                'email' => 'info@vodafonegh.com.gh',
                'website' => 'www.vodafone.com.gh',
                'logo-file' => $file
            ])
            ->assertOk()
            ->assertJson([
                'response_code' => 200,
                'response_message' => 'Company Updated successfully'
            ]);
    }

    public function test_the_delete_method()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create([
            'name' => 'Vodafone Gh',
            'email' => 'info@vodafonegh.com.gh',
            'website' => 'www.vodafone.com.gh'
        ]);

        $this->actingAs($user, 'web')
            ->json("delete", "/company/" . $company->id)
            ->assertOk()
            ->assertJson([
                'response_code' => 200,
                'response_message' => 'Company deleted successfully!'
            ]);

        return $company;
    }
}
