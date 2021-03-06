<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  // protected $fillable = [
  //   'name', 'email', 'password', 'status', 'slug'
  // ];
  protected $guarded = [];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  // public function setNameAttribute($value)
  // {
  //   $this->attributes['name'] = $value;
  //   $this->attributes['slug'] = str_slug($value);
  // }

  // public function setSlugAttribute($value)
  // {
  //   $this->attributes['slug'] = str_slug($value);
  // }

  // public function setPasswordAttribute($value)
  // {
  //   $this->attributes['password'] = bcrypt($value);
  // }
}
