<?php
// app/Services/Auth/JsonGuard.php
namespace Modules\FAC\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\TokenGuard as BaseGuard;
 
class Guard extends TokenGuard implements Guard
{
 
  protected $user;
  protected $lastAttempted;
     
  /**
     * Attempt to authenticate the user using the given credentials and return the token.
     *
     * @param  array  $credentials
     * @param  bool  $login
     *
     * @return bool|string
     */
    public function attempt(array $credentials = [], $login = true)
    {
        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        if ($this->hasValidCredentials($user, $credentials)) {
            return $login ? $this->login($user) : true;
        }

        return false;
    }

    /**
     * Create a token for a user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     *
     * @return string
     */
    public function login(Authenticatable $user) {
    	return $user ? ($user->is_banned ? false : $this->setUser($user)->user()->api_key) : false;
    }

	/**
     * Determine if the user matches the credentials.
     *
     * @param  mixed  $user
     * @param  array  $credentials
     *
     * @return bool
     */
    protected function hasValidCredentials($user, $credentials)
    {
        return $user !== null && $this->provider->validateCredentials($user, $credentials);
    }
}
