<?php

use Illuminate\Database\Eloquent\Builder;

trait Multitenantable
{
  protected static function bootMultitenantable(): void
  {
    static::creating(function ($model) {
      $model->user_id = auth()->id();
    });

    //do not add global scope for admin user
    if (!auth()->user()->is_admin) {
      static::addGlobalScope('created_by_user_id', function (Builder $builder) {
        $builder->where('user_id', auth()->id());
      });
    }
  }
}
