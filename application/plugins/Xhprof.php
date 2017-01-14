<?php

class XhprofPlugin extends Yaf_Plugin_Abstract
{
    /**
     * Xhprof开启状态
     * @var boolean
     */
    private static $_xhprof_on;


    public function dispatchLoopStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        $application_conf = Yaf_Registry::get('application');

        //如果没有开启xhprof or 采样率小于0 or 随机数大于1，就关闭采样
        if (intval($application_conf['xhprof']['percent']) <= 0 || mt_rand(1, intval($application_conf['xhprof']['percent'])) > 1) {
            self::$_xhprof_on = false;
        } else {

            self::$_xhprof_on = true;
            xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_NO_BUILTINS, array('ignored_functions' => array('call_user_func', 'call_user_func_array')));
        }
    }


    public function dispatchLoopShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        if (self::$_xhprof_on === true) {
            $controller = $request->getControllerName();
            $action = $request->getActionName();
            $module = $request->getModuleName();
            $XHProfRuns_Default = new XHProfRuns_Default();
            $XHProfRuns_Default->save_run(xhprof_disable(), $module . '_' . $controller . '_' . $action);
        }
    }
}