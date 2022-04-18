<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Personne extends Model{
        protected $table = 'personnes';
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
            'nom',
            'prenom',
            'genre',
            'naissance',
            'tel',
            'adresse',
            'cin',
        ];

        public function getIdAttribute(){
            return $this->attributes['id'];
        }

        public function getNomAttribute(){
            return $this->attributes['nom'];
        }

        public function setNomAttribute($value){
            $this->attributes['nom'] = $value;
        }

        public function getPrenomAttribute(){
            return $this->attributes['prenom'];
        }

        public function setPrenomAttribute($value){
            $this->attributes['prenom'] = $value;
        }

        public function getGenreAttribute(){
            return $this->attributes['genre'];
        }

        public function setGenreAttribute($value){
            $this->attributes['genre'] = $value;
        }

        public function getNaissanceAttribute(){
            return (date('D d F Y',strtotime($this->attributes['naissance'])));
        }

        public function getNaissanceNotFormattedAttribute(){
            return $this->attributes['naissance'];
        }

        public function setNaissanceAttribute($value){
            $this->attributes['naissance'] = $value;
        }

        public function getTelAttribute(){
            return substr($this->attributes['tel'], 0, 2)." ".substr($this->attributes['tel'], 2, 3)." ".substr($this->attributes['tel'], 5, 3);
        }

        public function getTelNotFormattedAttribute(){
            return $this->attributes['tel'];
        }

        public function setTelAttribute($value){
            $this->attributes['tel'] = $value;
        }

        public function getAdresseAttribute(){
            return $this->attributes['adresse'];
        }

        public function setAdresseAttribute($value){
            $this->attributes['adresse'] = $value;
        }

        public function getCinAttribute(){
            return $this->attributes['cin'];
        }

        public function setCinAttribute($value){
            $this->attributes['cin'] = $value;
        }
    }
?>
