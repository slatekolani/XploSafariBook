<?php

namespace App\Repositories\Access;

use App\Jobs\Notifications\SendSms;
use App\Models\Auth\User;
use App\Notifications\Auth\SendConfirmationCode;
use App\Notifications\Auth\SendConfirmationCodeAndPassword;
use App\Notifications\Auth\UserNeedsConfirmation;
use App\Repositories\BaseRepository;
use App\Repositories\System\CountryRepository;
use App\Repositories\Workflow\WfDefinitionRepository;
use function foo\func;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Yajra\DataTables\DataTables;

class UserRepository extends BaseRepository
{
    const MODEL = User::class;

    protected $company;
    protected $staff;

    public function __construct()
    {

    }

    public function getQuery()
    {
        return $this->query();
    }


    /*Get user*/
    public function getUsersForSelect()
    {
        return $this->query()->orderBy('username')->get()->pluck('fullname', 'id');
    }

    /**
     * @param array $input
     * @return mixed
     * Register company, both clearing and forwarding agents and normal company
     */
    public function create(array $input, $isAdmin = false)
{
    $user = DB::transaction(function () use ($input, $isAdmin) {
        // Ensure confirmation code is generated
        $input['confirmation_code'] = mt_rand(100000, 999999);

        // Create the user with the provided role, which is now mandatory
        $user = $this->query()->create([
            'username' => $input['username'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'confirmation_code' => $input['confirmation_code'],
            'password' => bcrypt($input['password']),
            'role' => $input['role']  // Use the role provided by user input
        ]);

        // Send registration notification
        $this->sendRegistrationNotification($user);

        return $user;
    });

    return $user;
}

    

    /*Send registration notification*/
    public function sendRegistrationNotification(Model $user)
    {
        //Send Confirmation Code Email
        $user->notify(new UserNeedsConfirmation());

        /* Send Welcome SMS */
        // SendSms::dispatch($user, trans("strings.sms.registered") . ' ' . $user->confirmation_code);
    }


    /* Update user information */
    public function update($user, array $input)
    {

        $defaultRole=$user->role;
        return DB::transaction(function () use ($input, $user,$defaultRole) {
            $user->update([
                'username' => $input['username'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'role' => $defaultRole
            ]);

            return $user;
        });

    }


    /**
     * @param array $input
     * @return mixed
     * Change Password of contact person /portal user.
     */
    public function changePassword($user, array $input)
    {
        $user->update(['password' => bcrypt($input['password'])]);
        return $user;
    }


    /**
     * @param $token
     * @return mixed
     */
    public function findByConfirmationToken($token)
    {
        return $this->query()->where('confirmation_code', $token)->first();
    }

    /**
     * @param $token
     * @return mixed
     * @throws GeneralException
     */
    public function confirmAccount($token)
    {
        $user = $this->findByConfirmationToken($token);

        if ($user->confirmed == '1') {
            throw new GeneralException(__('exceptions.auth.confirmation.already_confirmed'));
        }

        if ($user->confirmation_code == $token) {
            $user->confirmed = '1';
            $user->save();
            return access()->login($user);
        }
        throw new GeneralException(trans('exceptions.auth.confirmation.mismatch'));
    }

    public function getName($id)
    {
        $user = $this->query()->select('name')->where('id', $id)->first()->name;
        return $user;
    }


    public function attachRoles(array $input, Model $user)
    {
        $role_array = [];
        foreach ($input as $key => $value) {
            switch ($key) {
                case 'roles':
                    $role_array = $value;
                    break;
            }
        }
        $user->roles()->sync($role_array);

    }


    /**
     * @param Model $user
     * Attach permissions based on roles attached to the user
     */
    public function attachRolePermissions(Model $user)
    {
        $array = [];
        $permissions = [];
        $roles = $user->roles;
        foreach ($roles as $role) {
            $array = $role->permissions()->pluck("permissions.id")->all();
//            $array = $permissions;
            $permissions = array_merge($array, $permissions);
        }

        $user->permissions()->sync($permissions);

    }


    /**
     * @return int
     * Generate 6 digits
     */
    public function randomConfirmationCode()
    {
        return mt_rand(100000, 999999);
    }


    public function destroy(User $user)
    {
        DB::table('user_logs')->where('user_id', $user->id);
        $user->delete();
        return true;
    }


}
