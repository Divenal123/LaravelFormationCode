<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //On signale qu'on va utiliser lees contraintes d'intégrité référentielles
        //Schema::disabledForeignKeysConstraints();
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->year('year');
            $table->text('description');
            //On crée un champ qui va revevoir la clé étrangère venant de la table films
            $table->unsignedBigInteger('category_id');
            //On spécifie la clé étrangère en disant que c'est la colonne que je venais de créer. On fait aussi des restrictions
            //que ce soit pour les suppressions ou les modifications
            /*$table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict')
                ->onUpdate('restrict');*/
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}
