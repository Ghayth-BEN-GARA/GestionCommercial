<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Categorie extends Model{
        protected $table = 'categories';
        protected $primaryKey = 'nom';
        public $timestamps = false;
        public $incrementing = false;
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'nom',
        ];

        public function getNomAttribute(){
            return $this->attributes['nom'];
        }

        public function setNomAttribute($value){
            $this->attributes['nom'] = $value;
        }
    }
?>
