<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateFactures extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('factures', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->string('referenceF',999)->primary();
                $table->date('date');
                $table->time('heure');
                $table->string('type',4)->default('FACT');
                $table->string('par',550);
                $table->string('matricule',999);
                $table->foreign('matricule')->references('matricule')->on('fournisseurs')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('factures');
        }
    }
?>
