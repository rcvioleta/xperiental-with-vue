<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];

    /* search for slug instead of, by default ids  */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * automatically make a slug variable before storing to database 
     * use case: 
     * Subject::create($request->all()) 
     * 
     * instead of: 
     * Subject::create([
     *  'name' => $request->name, 
     *  'slug' => str_slug($request->name)
     * ]) 
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }
}
