<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Stock extends Model{
        protected $table = 'stocks';
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
            'qteStock',
            'prix',
            'reference'
        ];

        public function getIdAttribute(){
            return $this->attributes['id'];
        }

        public function getQteStockAttribute(){
            return $this->attributes['qteStock'];
        }

        public function setQteStockAttribute($value){
            $this->attributes['qteStock'] = $value;
        }

        public function getPrixAttribute(){
            return $this->attributes['prix'];
        }

        public function setPrixAttribute($value){
            $this->attributes['prix'] = $value;
        }

        public function getReferenceAttribute(){
            return $this->attributes['reference'];
        }

        public function setReferenceAttribute($value){
            $this->attributes['reference'] = $value;
        }
    }
?>
