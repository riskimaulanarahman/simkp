<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SA_MasterUser extends Model
{
    protected $table = "users";

    protected $guarded = ['id_users'];

    protected $primaryKey = 'id_users';

    // protected $fillable = [
    //     'example'
    // ];

    protected $hidden = [
        'password',
        'pass_txt',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    public function mahasiswa()
    {
        return $this->hasOne('App\Model\SA_Mahasiswa','id_users');
    }

    public function dosen()
    {
        return $this->hasMany('App\Model\SA_Dosen','id_users');
    }

    public function koor()
    {
        return $this->hasMany('App\Model\SA_Koordinator','id_users');
    }

    public function tendik()
    {
        return $this->hasOne('App\Model\SA_Tendik','id_users');
    }

    // public function log()
    // {
    //     return $this->hasMany('App\Model\SA_Dosen','id_users');
    // }
}
