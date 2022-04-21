<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Reglement extends Model{
        protected $table = 'reglements';
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
            'net',
            'paye',
            'date',
            'referenceF'
        ];

        public function getIdAttribute(){
            return $this->attributes['id'];
        }

        public function getNetAttribute(){
            return $this->attributes['net'];
        }

        public function setNetAttribute($value){
            $this->attributes['net'] = $value;
        }

        public function getPayeAttribute(){
            return $this->attributes['paye'];
        }

        public function setPayeAttribute($value){
            $this->attributes['paye'] = $value;
        }

        public function getDateAttribute(){
            return (date('D d F Y',strtotime($this->attributes['date'])));
        }

        public function setDateAttribute($value){
            $this->attributes['date'] = $value;
        }

        public function getReferenceFAttribute(){
            return $this->attributes['referenceF'];
        }

        public function setReferenceFAttribute($value){
            $this->attributes['referenceF'] = $value;
        }
    }
?>
