<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreWebVitalUrlRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_web_vital_url_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('core_web_vital_url_id');
            $table->foreign('core_web_vital_url_id')->references('id')->on('core_web_vital_urls');
            $table->double('cls', 12, 2)->default(0);
            $table->double('lcp', 12, 2)->default(0);
            $table->double('fcp', 12, 2)->default(0);
            $table->double('fdi', 12, 2)->default(0);
            $table->date('date')->nullable();
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
        Schema::dropIfExists('core_web_vital_url_records');
    }
}
