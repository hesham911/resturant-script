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
     * @test
     */
    public function checkSuppplyStatusFalse()
    {
        $supply = factory(Supply::class)->create();
        $this->SendRequest($supply->quantity - 1 , $supply);
        $supply = Supply::findOrFail($supply->id);
        $this->assertEquals(false , $supply->status );
    }

    /**
     * @test
     */
    public function checkSuppplyStatusTrue()
    {
        $supply = factory(Supply::class)->create();
        $this->SendRequest($supply->quantity , $supply );
        $supply = Supply::findOrFail($supply->id);
        $this->assertEquals(true , $supply->status );
    }


    private function SendRequest($quantity , $supply){
        $response = $this->getAdmin(route('damagedmaterials.store',[
            'group'=>[
                0=>[
                    'material_id' => $supply->material_id,
                    'user_id' => 1 ,
                    'quantity' => $quantity ,
                ]
            ]
        ]));
    }


    private function getAdmin($uri ){
        $user = factory(User::class)->create();
        return  $this->actingAs($user)
        ->get($uri);
    }
}
