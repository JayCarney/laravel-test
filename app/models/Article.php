<?php

class Article extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    public function user()
    {
        return $this->belongsTo('User', 'author_id');
    }

}
