<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('email',150);
            $table->string('birthDate',150);
            $table->string('cpf',150);
            $table->string('street',150); // route
            $table->string('number',20); // street_number
            $table->string('complements',150); // subpremise
            $table->string('neighborhood',100); // sublocality
            $table->string('zip',10); // postal_code
            $table->string('states',2); // administrative_area_level_1
            $table->string('city',100); //  administrative_area_level_2
            $table->decimal('lat',11, 8); //
            $table->decimal('lng',11, 8); //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
