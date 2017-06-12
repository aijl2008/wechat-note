<?php
namespace Awz\Note\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notes';

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
        'openid' ,
        'nickname' ,
        'content' ,
        'image' ,
        'width' ,
        'height'
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

    protected $appends = [ 'abstract' ];

    public function getAbstractAttribute () {
        if ( strlen ( $this->attributes[ 'content' ] ) <= 100 ) {
            return $this->attributes[ 'content' ];
        }
        route ( 'notes.note.view' , $this->attributes[ 'id' ] );
        return str_limit ( $this->attributes[ 'content' ] , 100 ) . '&gt;&gt;<a href="Note.php" target="_blank">MORE</a>';
    }
}
