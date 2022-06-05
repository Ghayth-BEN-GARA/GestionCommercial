<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Validation extends Model{
        protected $table = 'validations';
        protected $primaryKey = 'id';
        public $timestamps = false;
        public $incrementing = false;
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'id',
            'min_prix',
            'max_prix',
            'prix',
            'date_creation',
            'reference'
        ];

        public function getIdAttribute(){
            return $this->attributes['id'];
        }

        public function getMinPrixAttribute(){
            return $this->attributes['min_prix'];
        }

        public function setMinPrixAttribute($value){
            $this->attributes['min_prix'] = $value;
        }

        public function getMaxPrixAttribute(){
            return $this->attributes['max_prix'];
        }

        public function setMaxPrixAttribute($value){
            $this->attributes['max_prix'] = $value;
        }

        public function getPrixAttribute(){
            return $this->attributes['prix'];
        }

        public function setPrixAttribute($value){
            $this->attributes['prix'] = $value;
        }

        public function getDateCreationAttribute(){
            return $this->attributes['date_creation'];
        }

        public function setDateCreationAttribute($value){
            $this->attributes['date_creation'] = $value;
        }

        public function getReferenceAttribute(){
            return $this->attributes['reference'];
        }

        public function setReferenceAttribute($value){
            $this->attributes['reference'] = $value;
        }
    }
?>
