<?php namespace Inventory;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    public function categories()
    {
        return $this->hasMany('Inventory\Category');
    }

    public function items()
    {
        return $this->hasMany('Inventory\Item');
    }

    public function projects()
    {
        return $this->hasMany('Inventory\Project');
    }

    public function references()
    {
        return $this->hasManyThrough('Inventory\Reference', 'Inventory\Item');
    }

    /**
     * Returns true if the user has any references not assigned to a project.
     *
     * @return boolean True if the user has spare references
     */
    public function hasSpares()
    {
        return (null !== $this->references()
                        ->where('quantity', '>', 0)
                        ->whereNull('project_id')
                        ->first());
    }
}
