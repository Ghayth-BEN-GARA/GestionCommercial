<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;

    class Image extends Model{
        protected $table = 'Images';
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
            'photo',
            'cin',
        ];

        public function getIdAttribute(){
            return $this->attributes['id'];
        }

        public function getPhotoAttribute(){
            return $this->attributes['photo'];
        }

        public function setPhotoAttribute($value){
            $this->attributes['photo'] = $value;
        }

        public function getCinAttribute(){
            return $this->attributes['cin'];
        }

        public function setCinAttribute($value){
            $this->attributes['cin'] = $value;
        }
    }
?>
