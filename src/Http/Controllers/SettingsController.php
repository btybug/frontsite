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
use Btybug\btybug\Helpers\helpers;
use Btybug\btybug\Helpers\MainHelper as Helper;
use Btybug\FrontSite\Services\SettingsService;
use Btybug\btybug\Repositories\AdminsettingRepository as Settings;
use Btybug\btybug\Repositories\AdminsettingRepository;
use Btybug\FrontSite\Repository\VersionsRepository;
use Validator;

/**
 * Class SystemController
 * @package Btybug\Settings\Http\Controllers
 */
class SettingsController extends Controller
{
    /**
     * @var Settings|null
     */
    private $settings = null;
    /**
     * @var helpers|null
     */
    private $helpers = null;

    /**
     * SystemController constructor.
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->helpers = new helpers;
        $this->settings = $settings;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $languages = Helper::getAllLanguages();
        $config = Helper::getConfiguration();
        $timezones = Helper::getAllTimezones();
        $groups = [];//MemberGroups::pluck('title', 'id');
        $system = $this->settings->getSystemSettings();
        $data = [
            'groups' => $groups,
            'languages' => $languages,
            'config' => $config,
            'timezones' => $timezones,
            'category' => null,
            'system' => $system
        ];
        return view('manage::system.general', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMain()
    {
        $system = $this->settings->getSystemSettings();
        $languages = Helper::getAllLanguages();
        $config = Helper::getConfiguration();
        $timezones = Helper::getAllTimezones();
        $groups = [];//MemberGroups::pluck('title', 'id');
        $data = [
            'groups' => $groups,
            'languages' => $languages,
            'config' => $config,
            'timezones' => $timezones,
            'category' => null,
            'system' => $system
        ];
        return view('manage::system.main', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postMain(Request $request)
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNotifications()
    {

        return view('manage::system.notifications');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUrlMenger()
    {

        return view('manage::system.url_manager');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLoginRegistration()
    {
        $languages = Helper::getAllLanguages();
        $config = Helper::getConfiguration();
        $timezones = Helper::getAllTimezones();
        $groups = [];//MemberGroups::pluck('title', 'id');
        $system = $this->settings->getSystemSettings();
        $data = [
            'groups' => $groups,
            'languages' => $languages,
            'config' => $config,
            'timezones' => $timezones,
            'category' => null,
            'system' => $system
        ];

        return view('manage::system.login_registration', $data);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSystem(Request $request)
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveSocialApiKeys(Request $request)
    {
        $input = $request->except(['_token']);
        if ($this->settings->saveSocialApiKey($input)) {
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function urlManager(Request $request)
    {
        $data = $request->all();
        if ($this->settings->urlManager($data)) {
            return redirect()->back();
        }
    }

    /**
     * @return mixed
     */
    public function getAdminemails()
    {
        $emails = [];
        $data = $this->settings->getBy('section', 'admin_emails')->toArray();
        foreach ($data as $rs) {
            $emails[$rs['settingkey']] = $rs['val'];
        }

        return view('manage::system.admin_emails', compact(['emails']));
    }


    /**
     * @param Request $request
     */
    public function postAdminemails(Request $request)
    {
        $input = $request->except('_token');

        $validator = Validator::make(
            $request->all(),
            [
                'info' => 'required|email',
                'support' => 'required|email',
                'admin' => 'required|email',
                'sales' => 'required|email',
                'technical_staff' => 'required|email',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $this->settings->updateSystemSettings($input, 'admin_emails');
            $this->helpers->updatesession('Admin Emails successfully updated');

            return redirect()->back();
        }
    }

    public function getLang()
    {
        return view('manage::system.lang');
    }

    public function getApi()
    {
        return view('manage::system.api');
    }
    public function getFrontSettings(VersionsRepository $versionsRepository, AdminsettingRepository $adminsettingRepository)
    {
        $cssData = $versionsRepository->wherePluck('type', 'css', 'name', 'id')->toArray();
        $jsData = $versionsRepository->getJSLiveLinks(true)->toArray();
        $model = $adminsettingRepository->getVersionsSettings('versions', 'frontend');
        return view('manage::system.front_settings', compact(['cssData', 'model', 'jsData']));
    }
    public function postFrontSettings(Request $request, AdminsettingRepository $adminsettingRepository, SettingsService $service)
    {
        $data = $request->except('_token');
        $adminsettingRepository->createOrUpdateToJson($data, 'versions', 'frontend');

        return back()->with('message', 'Settings are saved');
    }


}
