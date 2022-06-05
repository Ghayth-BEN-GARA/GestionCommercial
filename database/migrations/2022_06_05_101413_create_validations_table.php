<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateValidationsTable extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('validations', function (Blueprint $table) {
                $table->id();
                $table->string('min_prix',999);
                $table->string('max_prix',999);
                $table->string('prix',999);
                $table->bigInteger('reference')->unsigned();
                $table->foreign('reference')->references('reference')->on('articles')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('validations');
        }
    }
?>
