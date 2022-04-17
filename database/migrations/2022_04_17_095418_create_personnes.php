<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreatePersonnes extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('personnes', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id();
                $table->string('nom',500);
                $table->string('prenom',500);
                $table->string('genre',150)->default('Non précisié');
                $table->date('naissance');
                $table->integer('tel');
                $table->string('adresse',500);
                $table->integer('cin');
                $table->foreign('cin')->references('cin')->on('comptes')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('personnes');
        }
    }
?>
