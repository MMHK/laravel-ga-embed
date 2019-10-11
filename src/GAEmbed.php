<?php
/**
 * Created by PhpStorm.
 * User: mixmedia
 * Date: 2019/10/11
 * Time: 12:08
 */

namespace MMHK\GA;


use Illuminate\Support\Facades\Facade;

class GAEmbed extends Facade
{
    protected static function getFacadeAccessor() {
        return 'GAEmbed';
    }
}