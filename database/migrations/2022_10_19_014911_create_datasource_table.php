<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasource', function (Blueprint $table) {
            $table->increments('id');
            $table->string('datasource_table', 255);
            $table->text('datasource_description');
            $table->date('datasource_acquired');
            $table->timestamps();

                  $table->unique([
                    'datasource_table'
                ], 'PrimaryDomainKey');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datasource');
    }
};
