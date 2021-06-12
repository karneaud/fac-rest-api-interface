<?php
namespace Modules\FAC\Console;

use App\Role;
use App\User;
use Webpatser\Uuid\Uuid;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\ConfirmableTrait;

class RegisterUserCommand extends Command
{
    use ConfirmableTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registers a user and returns an api key';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
       	try {
        	
        	if(is_null($first_name = $this->ask('Enter a valid first name'))) throw new \Exception('A first name is required!');
        	if(is_null($last_name = $this->ask('Enter a valid last name'))) throw new \Exception('A last name is required!');
        	if(is_null($username = $this->ask('Enter a valid username'))) throw new \Exception('A username is required!');
        	if(is_null($password = $this->ask('Enter a valid password'))) throw new \Exception('A password is required!');
        	if(is_null($email = $this->ask('Enter a unique valid email address'))) throw new \Exception('A unique and valid email address is required!');
        
        	if(is_null(($user = $this->createUser(compact('first_name','last_name','username','password','email'))))) throw new \Exception('New user not registered');
        } catch(\Exception $e) {
        	$this->error($e->getMessage());
        	return false;
        }
               
        $this->info("User registered with api key [{$user->api_key}] set successfully.");
    }

	private function createUser($details)
    {
       try {
       		 DB::beginTransaction();

        	$user = User::create([
            '_id'          => Uuid::generate(4)->string,
            'api_key'      => ($key = Uuid::generate(4)->string),
            'username'     => $details['username'],
            'password'     => Hash::make($details['password']),
            'first_name'   => $details['first_name'],
            'last_name'    => $details['last_name'],
            'email'        => $details['email'],
            'confirm_code' => Uuid::generate(4)->string,
        	'confirm_at' => date('Y-m-d H:i:s'),
            'created_by'   => 1,
            'updated_by'   => 1,
        	]);

       	 	$role = Role::getByName('user');
        	$user->roles()->syncWithoutDetaching(
            [
                $role->id => [
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ],
            ]
        	);

       	 	DB::commit();
			if(!$user) throw new \Exception('Could not create user!');
       } catch (\Exception $e) {
       		$this->error($e->getMessage());
       		return null;
       }
       
    	return $user;
    }
}