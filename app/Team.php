<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Team extends Model
{

    protected $fillable = ['name', 'size'];

    public function add($users)
    {

        $this->guardAgainstTooManyMembers($users);

        $method = $users instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($users);

    }

    public function remove($users = null)
    {

        if($users instanceof User) {

            return $users->leaveTeam();

        }

        return $this->removeMany($users);
    }

    public function removeMany($users)
    {

        return $this->members()
                    ->whereIn('id', $users->pluck('id'))
                    ->update(['team_id' => null]);

    }

    public function restart()
    {

        $this->members()->update(['team_id' => null]);

    }

    public function members()
    {

        return $this->hasMany(User::class);

    }

    public function count()
    {

        return $this->members()->count();

    }

    public function guardAgainstTooManyMembers($users)
    {

        $numOfUsers = ($users instanceof User) ? 1 : $users->count();

        $newTeamCount = $this->count() + $numOfUsers;

        if($newTeamCount > $this->size) {
            throw new \Exception;
        }

    }

}
