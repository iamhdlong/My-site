<?php
namespace User\Model;

use Core\Model\Model;

class User extends Model {
    const GROUP_ADMIN = 1;
    const GROUP_MEMBER = 2;

    public $table = 'b_user';


}