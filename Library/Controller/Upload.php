<?php
/**
 * Minecraft skin panel
 * Author: Sendya <18x@loacg.com>
 */

namespace Controller;

use \Model\User;

class Upload {

    private $form_name;  //文件form名称
    private $ext_arr = array('.jpg', '.png', '.gif', '.jpeg');    //允许上传的文件后缀
    private $upload_dir = DATA_PATH . "Upload/"; //上传目录
    private $file_size = 512;  //文件大小限制


    public function index() {
        global $user;
        $result = array("error" => 1, "message" => "上传失败");
        $file = $_FILES['Steve'];

        if (!is_dir($this->upload_dir)) mkdir($this->upload_dir, 0777); //上传目录不存在则创建
        if ($file['error'] == 1 || $file['size'] > ($this->file_size * 1024)) exit('1'); //上传失败，图片不能大于 $this->file_size k！
        switch ($file['error']) {
            case 3:
                $result['message'] = "皮肤上传不完整，请重新上传"; //图片只有部分文件被上传，请重新上传！
                break;
            case 4:
                $result['message'] = "没有任何文件被上传"; //没有任何文件被上传！
                break;
        }
        $ext = $this->getExt($file['name']);
        if (!in_array($ext, $this->ext_arr)) $result['message'] = "非图片类型，请上传jpg|png图片！";

        $localFileName = hash("sha256", $user->id . $user->username . time()); //文件名为 用户ID + 用户名 + UNIX时间戳

        $filename = $this->upload_dir . $localFileName;
        if (!move_uploaded_file($file['tmp_name'], $filename)) { //执行上传
            $result['message'] = "上传失败，未知错误"; //上传失败，错误未知
        } else {
            $result = array('error' => 0, 'fileName' => $localFileName, 'size' => $file['size']);
        }
        echo json_encode($result);
        exit();
    }

    public function delPic() {
        $filename = $_POST['file_name'];
        if (!empty($filename)) {
            unlink($this->upload_dir . $filename);
            echo '删除成功';
        } else {
            echo '删除失败.';
        }
    }

    /**
     * 获取文件后缀名
     * @param string $file_name 文件名称
     * @return string
     */
    private function getExt($file_name) {
        $ext = strtolower(strrchr($file_name, "."));
        return $ext;
    }
}