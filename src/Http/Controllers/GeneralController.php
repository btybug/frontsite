<?php
/**
 * Copyright (c) 2017.
 * *
 *  * Created by PhpStorm.
 *  * User: Edo
 *  * Date: 10/3/2016
 *  * Time: 10:44 PM
 *
 */

namespace Btybug\FrontSite\Http\Controllers;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Btybug\btybug\Helpers\dbhelper;
use Btybug\btybug\Helpers\helpers;
use Btybug\btybug\Repositories\AdminsettingRepository as Settings;

/**
 * Class SettingsController
 * @package Btybug\Frontend\Http\Controllers
 */
class GeneralController extends Controller
{

    /**
     * @var dbhelper|null
     */
    private $dbhelper = null;
    /**
     * @var helpers|null
     */
    private $helpers = null;

    /**
     * @var Settings|null
     */
    private $settings = null;

    /**
     * SettingsController constructor.
     * @param dbhelper $dbhelper
     * @param Settings $settings
     */
    public function __construct(dbhelper $dbhelper, Settings $settings)
    {
        $this->dbhelper = $dbhelper;
        $this->settings = $settings;
        $this->helpers = new helpers();
    }



    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSettings(Request $request)
    {
        $input = $request->except('_token');
        if ($request->file('site_logo')) {
            File::cleanDirectory('resources/assets/images/logo/');
            $name = $request->file('site_logo')->getClientOriginalName();
            $request->file('site_logo')->move('resources/assets/images/logo/', $name);
            $input['site_logo'] = $name;
        }
        $this->settings->updateSystemSettings($input);
        $this->helpers->updatesession('System successfully saved');
        return redirect()->back();
    }
}