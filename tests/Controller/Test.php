<?php

namespace Controller;

class Test extends \SlimController\SlimController {

    public function indexAction()
    {
        echo "What is up?";
    }

    public function helloAction($name)
    {
        echo "What is up $name?";
    }

    public function paramSingleAction()
    {
        echo "Param is ". $this->param('Some.param');
    }

    public function paramSingleObjectAction()
    {
        $obj = $this->param('Some');
        echo "Param is ". $obj['attrib1']. $obj['attrib2']. $obj['attrib3'];
    }

    public function paramMultiAction()
    {
        $params = $this->params(array('Some.param', 'Other.param', 'Other.missing'));
        if ($params && isset($params['Some.param']) && isset($params['Other.param'])) {
            echo "All is ". $params['Some.param']. ' '. $params['Other.param'];
        } else {
            echo "FAIL";
        }
    }

    public function paramMultiMissingAction()
    {
        $params = $this->params(array('Some.param', 'Other.param', 'Other.bla'));
        if ($params && isset($params['Some.param']) && isset($params['Other.param']) && !isset($params['Other.bla'])) {
            echo "All is ". $params['Some.param']. ' '. $params['Other.param'];
        } else {
            echo "FAIL";
        }
    }

    public function paramMultiMissingReqAction()
    {
        $params = $this->params(array('Some.param', 'Other.param', 'Other.bla'), 'get', true);
        echo !$params ? "OK" : "FAIL";
    }

    public function paramMultiDefaultAction()
    {
        $params = $this->params(array('Some.param', 'Other.param', 'Other.bla'), 'get', array('Other.bla' => 'great'));
        if ($params) {
            echo "All is ". $params['Some.param']. ' '. $params['Other.param']. ' and '. $params['Other.bla'];
        } else {
            echo "FAIL";
        }
    }

    public function paramDifferentPrefixAction()
    {
        $params = $this->params();
        echo "GOT ". (count($params) === 1 && isset($params['Foo']) && $params['Foo'] === 'bar' ? "OK" : "FAIL");
    }

    public function paramNoPrefixAction()
    {
        $params = $this->params();
        echo "All params: ". join(" - ", array_map(function($key) use ($params) {
            return sprintf('%s=%s', $key, $params[$key]);
        }, array_keys($params)));
    }


    public function renderAction()
    {
        $this->render('rendertest', array('foo' => 'orotound', 'bar' => 'grandios'));
    }
}