<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\common\model\Setting as CommonSetting;
use think\facade\Env;

class Setting extends Base
{
    public function index()
    {
        if ($this->request->isPost()) {
            foreach ($this->request->post('setting/a') as $key => $value) {
                CommonSetting::where('key', '=', $key)->update(['value' => $value]);
            }
            $app_debug = $this->request->post('app_debug') == 1;
            if ($app_debug !== config('app.app_debug')) {
                $file   = Env::get('config_path') . 'app.php';
                $config = file_get_contents($file);

                $config = preg_replace_callback('/[\'|\"]app_debug[\'|\"](.*?)=>(.*?)(false|true),/i', function ($matches) use ($app_debug) {
                    return "'app_debug'" . $matches['1'] . "=>" . $matches['2'] . ($app_debug == true ? 'true' : 'false') . ",";
                }, $config);
                $config = preg_replace_callback('/[\'|\"]app_trace[\'|\"](.*?)=>(.*?)(false|true),/i', function ($matches) use ($app_debug) {
                    return "'app_trace'" . $matches['1'] . "=>" . $matches['2'] . ($app_debug == true ? 'true' : 'false') . ",";
                }, $config);
                file_put_contents($file, $config);
            }
            (new CommonSetting)->update_cache();
            return $this->success('设置保存成功！');
        }
        return $this->fetch();
    }

    public function email()
    {
        if ($this->request->isPost()) {
            foreach ($this->request->post('setting/a') as $key => $value) {
                CommonSetting::where('key', '=', $key)->update(['value' => $value]);
            }
            (new CommonSetting)->update_cache();
            return $this->success('设置保存成功！');
        }
        return $this->fetch();
    }

    public function proxy()
    {
        if ($this->request->isPost()) {
            foreach ($this->request->post('setting/a') as $key => $value) {
                CommonSetting::where('key', '=', $key)->update(['value' => $value]);
            }
            (new CommonSetting)->update_cache();
            return $this->success('设置保存成功！');
        }
        return $this->fetch();
    }
}
