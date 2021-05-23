<?php

namespace App\Providers;

use App\Phone;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Validator::extend('unique_phone',function ($attribute,$value){
           $value = (int)$value;

           $phone = Phone::where('number',$value)->get();

           if (empty($phone)){
               return false;
           }
           return true;

       });
        Validator::extend('unique_phone_update',function ($attribute,$value,$parameters){

          $user =  User::where('id',$parameters['0'])->with('phones')->get();
         // dd($user[0]);
         foreach ($user[0]->phones as $k=> $phone){
             return    Rule::unique('phones','number')->ignore($phone->id,'id');

          }
        });
    }
}
