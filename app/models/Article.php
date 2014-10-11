<?php

class Article extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';
    protected $fillable = array('title', 'content', 'tag', 'tags');

    public function user()
    {
        return $this->belongsTo('User', 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany('Tag','article_tag');
    }

}
