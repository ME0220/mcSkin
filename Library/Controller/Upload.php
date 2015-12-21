<?php
/**
 * Minecraft skin panel
 * Author: Sendya <18x@loacg.com>
 */

namespace Controller;

use \Model\User;

class Upload {

    private $form_name;  //�ļ�form����
    private $ext_arr = array('.jpg', '.png', '.gif', '.jpeg');    //�����ϴ����ļ���׺
    private $upload_dir = DATA_PATH . "Upload/"; //�ϴ�Ŀ¼
    private $file_size = 512;  //�ļ���С����


    public function index() {
        global $user;
        $result = array("error" => 1, "message" => "�ϴ�ʧ��");
        $file = $_FILES['Steve'];

        if (!is_dir($this->upload_dir)) mkdir($this->upload_dir, 0777); //�ϴ�Ŀ¼�������򴴽�
        if ($file['error'] == 1 || $file['size'] > ($this->file_size * 1024)) exit('1'); //�ϴ�ʧ�ܣ�ͼƬ���ܴ��� $this->file_size k��
        switch ($file['error']) {
            case 3:
                $result['message'] = "Ƥ���ϴ����������������ϴ�"; //ͼƬֻ�в����ļ����ϴ����������ϴ���
                break;
            case 4:
                $result['message'] = "û���κ��ļ����ϴ�"; //û���κ��ļ����ϴ���
                break;
        }
        $ext = $this->getExt($file['name']);
        if (!in_array($ext, $this->ext_arr)) $result['message'] = "��ͼƬ���ͣ����ϴ�jpg|pngͼƬ��";

        $localFileName = hash("sha256", $user->id . $user->username . time()); //�ļ���Ϊ �û�ID + �û��� + UNIXʱ���

        $filename = $this->upload_dir . $localFileName;
        if (!move_uploaded_file($file['tmp_name'], $filename)) { //ִ���ϴ�
            $result['message'] = "�ϴ�ʧ�ܣ�δ֪����"; //�ϴ�ʧ�ܣ�����δ֪
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
            echo 'ɾ���ɹ�';
        } else {
            echo 'ɾ��ʧ��.';
        }
    }

    /**
     * ��ȡ�ļ���׺��
     * @param string $file_name �ļ�����
     * @return string
     */
    private function getExt($file_name) {
        $ext = strtolower(strrchr($file_name, "."));
        return $ext;
    }
}