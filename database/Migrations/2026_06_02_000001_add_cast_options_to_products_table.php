<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('ishoe__shoes', function (Blueprint $table) {
      $table->json('cast_options')->after('total_price')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('ishoe__shoes', function (Blueprint $table) {
      $table->dropColumn('cast_options');
    });
  }
};
