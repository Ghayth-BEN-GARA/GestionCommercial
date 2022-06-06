<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateStocks extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('stocks', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id();
                $table->integer('qteStock');
                $table->string('prix',999);
                $table->integer('marge')->default(20);
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
            Schema::dropIfExists('stocks');
        }
    }
?>
