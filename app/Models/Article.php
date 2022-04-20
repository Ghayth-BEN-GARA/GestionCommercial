<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Article extends Model{
        protected $table = 'articles';
        protected $primaryKey = 'reference';
        public $timestamps = false;
        public $incrementing = false;
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'reference',
            'designation',
            'categorie',
        ];

        public function getReferenceAttribute(){
            return $this->attributes['reference'];
        }

        public function setReferenceAttribute($value){
            $this->attributes['reference'] = $value;
        }

        public function getDesignationAttribute(){
            return $this->attributes['designation'];
        }

        public function setDesignationAttribute($value){
            $this->attributes['designation'] = $value;
        }

        public function getCategorieAttribute(){
            return $this->attributes['categorie'];
        }

        public function setCategorieAttribute($value){
            $this->attributes['categorie'] = $value;
        }
    }
?>
