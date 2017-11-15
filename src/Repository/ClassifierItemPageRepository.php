<?php
/**
 * Created by PhpStorm.
 * User: Arakelyan
 * Date: 31-Jul-17
 * Time: 18:05
 */

namespace Btybug\FrontSite\Repository;


use Btybug\btybug\Repositories\GeneralRepository;
use Btybug\FrontSite\Models\ClassifierItemPage;

class ClassifierItemPageRepository extends GeneralRepository
{
    public function model()
    {
        return new ClassifierItemPage();
    }

}