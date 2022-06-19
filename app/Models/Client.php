<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Client extends Model{
        protected $table = 'clients';
        protected $primaryKey = 'matricule';
        public $timestamps = false;
        public $incrementing = false;
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'matricule',
            'fullname',
            'adresse',
            'tel1',
            'tel2',
            'email',
        ];

        public function getMatriculeAttribute(){
            return $this->attributes['matricule'];
        }

        public function setMatriculeAttribute($value){
            $this->attributes['matricule'] = $value;
        }

        public function getFullnameAttribute(){
            return $this->attributes['fullname'];
        }

        public function setFullnameAttribute($value){
            $this->attributes['fullname'] = $value;
        }

        public function getAdresseAttribute(){
            return $this->attributes['adresse'];
        }

        public function setAdresseAttribute($value){
            $this->attributes['adresse'] = $value;
        }

        public function getTel1Attribute(){
            return $this->attributes['tel1'];
        }

        public function setTel1Attribute($value){
            $this->attributes['tel1'] = $value;
        }

        public function getTel2Attribute(){
            return $this->attributes['tel2'];
        }

        public function setTel2Attribute($value){
            $this->attributes['tel2'] = $value;
        }

        public function getEmailAttribute(){
            return $this->attributes['email'];
        }

        public function setEmailAttribute($value){
            $this->attributes['email'] = $value;
        }
    }
?>
