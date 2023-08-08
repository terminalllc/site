<?php

declare(strict_types=1);

namespace App\Http\Traits;


trait MsgTrait {

	public function msgInsert()
    {
        return 'Record added';
    }

	public function msgUpdate()
    {
        return 'The record has been updated';
    }

	public function msgDelete()
    {
        return 'Record deleted';
    }

	public function msgRestore()
    {
        return 'The recording has been restored';
    }

	public function msgCantDelete()
    {
        return 'The record cannot be deleted';
    }

	public function msgError()
    {
        return 'Error!';
    }

	public function msgErrorAdminUser()
    {
        return 'Error! Cannot delete a user with administrator rights';
    }

    public function msgErrorDefaultDelete()
    {
        return 'Warning! You cannot delete a default entry';
    }
}
