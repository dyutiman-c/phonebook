<?php
/**
 * Created by PhpStorm.
 * User: dyutiman
 * Date: 4/4/18
 * Time: 8:44 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Composer
{
    function __construct()
    {
        include("../vendor/autoload.php");
    }
}