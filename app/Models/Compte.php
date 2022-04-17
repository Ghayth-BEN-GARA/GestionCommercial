<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    use Carbon\Carbon;

    class Compte extends Model{
        protected $table = 'comptes';
        protected $primaryKey = 'cin';
        public $timestamps = false;
        public $incrementing = false;
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'cin',
            'password',
            'type',
            'date_creation',
            'heure_creation',
        ];

        public function getCinAttribute(){
            return $this->attributes['cin'];
        }

        public function setCinAttribute($value){
            $this->attributes['cin'] = $value;
        }

        public function getPasswordAttribute(){
            return $this->attributes['password'];
        }

        public function setPasswordnAttribute($value){
            $this->attributes['password'] = md5($value);
        }

        public function getTypeAttribute(){
            return $this->attributes['type'];
        }

        public function setTypeAttribute($value){
            $this->attributes['type'] = $value;
        }

        public function getDateCreationAttribute(){
            return (date('D d F Y',strtotime($this->attributes['date_creation'])));
        }

        public function setDateCreationAttribute(){
            $this->attributes['date_creation'] = date('Y/m/d');
        }

        public function getHeureCreationAttribute(){
            return Carbon::createFromFormat('H:i:s', $this->attributes['heure_creation'])->format('H:i');
        }

        public function setHeureCreationAttribute(){
            $this->attributes['heure_creation'] = date('H:i:s');
        }
    }
?>
