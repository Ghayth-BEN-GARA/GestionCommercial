<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class FactureArticle extends Model{
        protected $table = 'facturesarticles';
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
            'qte',
            'prixU',
            'reference',
            'referenceF'
        ];

        public function getIdAttribute(){
            return $this->attributes['id'];
        }

        public function getQteAttribute(){
            return $this->attributes['qte'];
        }

        public function setQteAttribute($value){
            $this->attributes['qte'] = $value;
        }

        public function getPrixUAttribute(){
            return $this->attributes['prixU'];
        }

        public function setPrixUAttribute($value){
            $this->attributes['prixU'] = $value;
        }

        public function getReferenceAttribute(){
            return $this->attributes['reference'];
        }

        public function setReferenceAttribute($value){
            $this->attributes['reference'] = $value;
        }

        public function getReferenceFAttribute(){
            return $this->attributes['referenceF'];
        }

        public function setReferenceFAttribute($value){
            $this->attributes['referenceF'] = $value;
        }
    }
?>
