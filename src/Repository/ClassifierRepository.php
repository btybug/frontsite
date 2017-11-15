<?php
/**
 * Created by PhpStorm.
 * User: Arakelyan
 * Date: 31-Jul-17
 * Time: 17:50
 */

namespace Btybug\FrontSite\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use Btybug\FrontSite\Models\Classifier;


class ClassifierRepository extends GeneralRepository
{

    public function model()
    {
        return new Classifier();
    }

}