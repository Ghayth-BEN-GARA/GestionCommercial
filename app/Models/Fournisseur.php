<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Fournisseur extends Model{
        protected $table = 'fournisseurs';
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
            'nom',
            'email',
            'adresse',
            'tel1',
            'tel2',
        ];

        public function getMatriculeAttribute(){
            return $this->attributes['matricule'];
        }

        public function setMatriculeAttribute($value){
            $this->attributes['matricule'] = $value;
        }

        public function getNomAttribute(){
            return $this->attributes['nom'];
        }

        public function setNomAttribute($value){
            $this->attributes['nom'] = $value;
        }

        public function getEmailAttribute(){
            return $this->attributes['email'];
        }

        public function setEmailAttribute($value){
            $this->attributes['email'] = $value;
        }

        public function getAdresseAttribute(){
            return $this->attributes['adresse'];
        }

        public function setAdresseAttribute($value){
            $this->attributes['adresse'] = $value;
        }

        public function getTel1NotFormattedAttribute(){
            return $this->attributes['tel1'];
        }

        public function setTel1Attribute($value){
            $this->attributes['tel1'] = $value;
        }

        public function getTel2NotFormattedAttribute(){
            return $this->attributes['tel2'];
        }

        public function setTel2Attribute($value){
            $this->attributes['tel2'] = $value;
        }

        public function getTel1Attribute(){
            return substr($this->attributes['tel1'], 0, 2)." ".substr($this->attributes['tel1'], 2, 3)." ".substr($this->attributes['tel1'], 5, 3);
        }

        public function getTel2Attribute(){
            return substr($this->attributes['tel2'], 0, 2)." ".substr($this->attributes['tel2'], 2, 3)." ".substr($this->attributes['tel2'], 5, 3);
        }
    }
?>
