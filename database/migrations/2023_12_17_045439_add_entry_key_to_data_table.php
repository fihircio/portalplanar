<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEntryKeyToDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data', function (Blueprint $table) {
            // Add the entry_key column
            $table->string('entry_key')->nullable()->after('content_id');
            
            // Add a foreign key to associate entry_key with content_id
            //$table->foreign('entry_key')->references('id')->on('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['entry_key']);
            
            // Drop the entry_key column if needed
            $table->dropColumn('entry_key');
        });
    }
}
