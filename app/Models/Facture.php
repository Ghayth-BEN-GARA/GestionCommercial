<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use Carbon\Carbon;

    class Facture extends Model{
        protected $table = 'factures';
        protected $primaryKey = 'referenceF';
        public $timestamps = false;
        public $incrementing = false;
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'referenceF',
            'date',
            'heure',
            'type',
            'par',
            'matricule',
        ];

        public function getReferenceFAttribute(){
            return $this->attributes['referenceF'];
        }

        public function setReferenceFAttribute($value){
            $this->attributes['referenceF'] = $value;
        }

        public function getDateAttribute(){
            return $this->attributes['date'];
        }

        public function setDateAttribute($value){
            return (date('D d F Y',strtotime($this->attributes['date'])));
        }

        public function getHeureAttribute(){
            return $this->attributes['heure'];
        }

        public function setHeureAttribute($value){
            return Carbon::createFromFormat('H:i:s', $this->attributes['heure'])->format('H:i');
        }

        public function getTypeAttribute(){
            return $this->attributes['type'];
        }

        public function setTypeAttribute($value){
            $this->attributes['type'] = $value;
        }

        public function getParAttribute(){
            return $this->attributes['par'];
        }

        public function setParAttribute($value){
            $this->attributes['par'] = $value;
        }

        public function getMatriculeAttribute(){
            return $this->attributes['matricule'];
        }

        public function setMatriculeAttribute($value){
            $this->attributes['matricule'] = $value;
        }
    }
?>
