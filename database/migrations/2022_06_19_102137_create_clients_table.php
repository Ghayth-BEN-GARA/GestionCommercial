<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateClientsTable extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('clients', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->string('matricule',999)->primary();
                $table->string('fullname',999);
                $table->string('adresse',999);
                $table->integer('tel1')->length(8);
                $table->integer('tel2')->length(8);
                $table->string('email',999);
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('clients');
        }
    }
?>
