<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateFournisseurs extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('fournisseurs', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->string('matricule',999)->primary();
                $table->string('nom',500);
                $table->string('email',300);
                $table->string('adresse',999);
                $table->integer('tel1');
                $table->integer('tel2')->default(null);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('fournisseurs');
        }
    }
?>
