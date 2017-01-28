<?php


class Magic {

    public $from;
    protected $fields = "All";
    public $where;
    private $_ci;

    public function __construct() {
        $this->_ci = &get_instance();
        $this->_ci->load->helper('inflector');
    }


    /**
     * @set model name
     * @param $name
     * @return $this
     */
    public function __get($name) {
        $this->from = $name;
        return $this;
    }


    /**
     * @param $method
     * @param $arguments
     * @return bool
     */
    public function __call($method, $arguments) {
       return  $this->_handleCalls($method, $arguments);
    }


    /**
     * @param $filed
     * @param $arguments
     * @return bool
     */
    private function _handleCalls($filed, $arguments) {
        $method = substr($filed,4);

        switch ($method) {
            case $this->fields:
                if(count($arguments) > 0)
                    $this->where =  ($arguments[0]);
                break;

            case (strpos($filed,'By') > 0) :
                $filed = substr($method,(strpos(substr($method,4),'By')+2));
                $this->where = array(from_camel_case($filed) => $arguments[0]);
                break;

            default:
                trigger_error('Call to undefined method '.__CLASS__.'::'.$method.'()', E_USER_ERROR);
        }
        return $this->_setConditions();

    }


    /**
     * @return bool
     */
    private function _setConditions() {
        $this->_ci->db->from(from_camel_case(plural($this->from)));
        if($this->where) {
            $this->_ci->db->where($this->where);
        }
        $res = $this->_ci->db->get();
        return $res->result_array();
    }
}