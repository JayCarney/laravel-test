<?php

class Tag extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';
    protected $fillable = array('tag');
    public function articles()
    {
        return $this->belongsToMany('Article', 'article_tag');
    }

}
