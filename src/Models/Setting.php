<?php
namespace Aijl\Note\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name' ,
        'logo'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ ];

    protected $appends = [ 'logosrc' ];


    public function getLogosrcAttribute () {
        return "<img src='http://note.awz.cn/image/setting/{$this->id}' >";
    }

}



