<?php

use App\Models\User;

function admin()
{
    return User::where('type', 'admin')->first();
}
