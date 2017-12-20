<?php
/**
 * Created by PhpStorm.
 * User: Star
 * Date: 12/16/2017
 * Time: 3:28 AM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['email']	= Array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.googlemail.com',
    'smtp_port' => 465,
    'smtp_user' => 'xxx',
    'smtp_pass' => 'xxx',
    'mailtype'  => 'html',
    'charset'   => 'iso-8859-1'
);