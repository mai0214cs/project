<?php

namespace App\Http\Libraries;

class ConvertData {

    public $data = [];
    public $status = 200;

    private function array_to_xml($array, &$xml_user_info) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subnode = $xml_user_info->addChild("$key");
                    $this->array_to_xml($value, $subnode);
                } else {
                    $subnode = $xml_user_info->addChild("item$key");
                    $this->array_to_xml($value, $subnode);
                }
            } else {
                $xml_user_info->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }

    function XML() {
        $xml_user_info = new \SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");
        $this->array_to_xml($this->data, $xml_user_info);
        return response($xml_user_info->asXML(), $this->status)->header('Content-Type', 'text/xml');
    }

    function JSON() {
        return response($this->data, $this->status)->header('Content-Type', 'application/json');
    }

    private function EncryptData($content) {
        return str_replace(array("&", "<", ">", '"', "'"), array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;"), $content);
    }

    function EXCEL() {
        $i = 0; $head = ''; $body = '';
        foreach ($this->data as $data) {
            $item = '';
            foreach ($data as $key => $value) {
                if ($i == 0) { $head .= '<th>' . $this->EncryptData($key) . '</th>'; }
                $item .= '<td>'.$this->EncryptData(is_array($value)? json_encode($value):$value).'</td>'; 
                
            }
            $body .= '<tr>'.$item.'</tr>';
            $i++;
        }
        return response('<table><thead><tr>'.$head.'</tr></thead><tbody>'.$body.'</tbody></table>', $this->status, [
            'Pragma' => 'public',
            'Expires' => 'public',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Cache-Control' => 'private',
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=document_excel.xls',
            'Content-Transfer-Encoding' => ' binary'
        ]);
    }

}
