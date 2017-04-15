<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteUserPostIdAddPolymorphic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->integer('imageable_id');
            $table->string('imageable_type');
            
            if (Schema::hasColumn('post_id','is_profile'))
            {
                $table->dropForeign('post_id');
                $table->dropColumn('is_profile');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->integer('post_id');
            $table->integer('is_active');
            $table->dropColumn('imageable_id');
            $table->dropColumn('imageable_type');
        });
    }
}
