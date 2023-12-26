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
         Schema::table('datasource', function (Blueprint $table) {
             if (Schema::hasColumn('datasource', 'email_field')) {
                 // Add "datacheck" after "email_field"
                 $table->string('datacheck')->nullable()->after('email_field');
             } else {
                 // Add both "email_field" and "datacheck"
                 $table->string('email_field')->nullable()->after('datasource_acquired');
                 $table->string('datacheck')->nullable();
             }
         });
     }

     /**
      * Reverse the migration.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('datasource', function (Blueprint $table) {
             // Drop both "email_field" and "datacheck" columns
             $table->dropColumn(['email_field', 'datacheck']);
         });
     }
};
