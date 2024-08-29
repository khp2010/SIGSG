<?php

namespace Dtic\Personnels;
use Illuminate\Support\ServiceProvider;



class PersonnelServiceProvider extends ServiceProvider{
    
    public function register(){

    }

    public function boot(){
        $this->loadMigrationsFrom(__DIR__."/database/migrations");
        $this->loadRoutesFrom(__DIR__."/routes/api.php");
    }

}