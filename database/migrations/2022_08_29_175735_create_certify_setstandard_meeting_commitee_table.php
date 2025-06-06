<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertifySetstandardMeetingCommiteeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certify_setstandard_meeting_commitee', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('setstandard_meeting_id')->nullable()->comment('id ตาราง certify_setstandard_meeting');
            $table->integer('commitee_id')->nullable()->comment('id ตาราง bcertify_committee_specials');
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('certify_setstandard_meeting_commitee');
    }
}
