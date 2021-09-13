<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Supply;
use App\Material;
use App\MaterialDamaged;
use App\User;
use Illuminate\Support\Facades\Auth;


class MaterialDamageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function checkSuppplyNotStatusFalse()
    {
        $supply = factory(Supply::class)->make();
        // $materialDamaged = factory(MaterialDamaged::class)->make();
        $response = $this->getAdmin(route('damagedmaterials.store',[
            'material_id' => $supply->material_id,
            'user_id' => 1 ,
            'quantity' => $supply->quantity - 1,
        ]));
        $response->assertEquals(false , $supply->status );
    }

    private function getAdmin($uri ){
        $user = User::factory(App\User::class)->make();
        return $response = $this->actingAs($user)
        ->get($uri);
    }
}
