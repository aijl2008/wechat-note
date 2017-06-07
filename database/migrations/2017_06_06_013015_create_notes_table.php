<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create ( 'notes' , function ( Blueprint $table ) {
            $table->increments ( 'id' );
            $table->string ( 'openid' );
            $table->string ( 'nickname' )->nullable ()->default ( null );
            $table->longText ( 'content' )->nullable ()->default ( null );
            $table->longText ( 'image' )->nullable ()->default ( null );
            $table->integer ( 'width' )->default ( 0 );
            $table->integer ( 'height' )->default ( 0 );
            $table->timestamps ();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::drop ( 'notes' );
    }
}
