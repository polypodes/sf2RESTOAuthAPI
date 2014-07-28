<?php
/**
 * Created by PhpStorm.
 * User: ronan
 * Date: 28/07/2014
 * Time: 16:40
 */

$set = new h4cc\AliceFixturesBundle\Fixtures\FixtureSet(array(
    'locale' => 'fr_FR',
    'seed' => 42,
    'do_drop' => true,
    'do_persist' => true,
));

$set->addFile(__DIR__.'/books.yml', 'yaml');

return $set;