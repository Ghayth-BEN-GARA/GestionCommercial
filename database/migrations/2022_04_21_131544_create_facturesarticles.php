<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateFacturesarticles extends Migration{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(){
            Schema::create('facturesarticles', function (Blueprint $table) {
                $table->collation = 'utf8_general_ci';
                $table->charset = 'utf8';
                $table->id();
                $table->integer('qte');
                $table->string('prixU',999);
                $table->bigInteger('reference')->unsigned();
                $table->string('referenceF',999);
                $table->foreign('reference')->references('reference')->on('articles')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('referenceF')->references('referenceF')->on('factures')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(){
            Schema::dropIfExists('facturesarticles');
        }
    }
?>
