 <?php
 class XhprofPlugin extends Yaf_Plugin_Abstract {

	 public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
	 	echo "xhprof";
	 }

	 public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response) {
	 	echo "xhprof_end";
	 }
 }