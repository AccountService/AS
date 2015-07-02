<?php
Use Symfony\Component\HttpFoundation\Request;
class Index {
    public function __construct(Request $request){
        $this->request = $request;
    }
    private function getIndexPage()
    {
        include_once('view/Index/index.php');
    }
    private function getKeysPage()
    {
        include_once('view/Keys/index.php');
    }
    private function getRegPage()
    {
        include_once('view/Reg/index.php');
    }
    private function discardAct()
    {
        include_once('view/Discard/index.php');
    }
    private function getcancelPage()
    {
        include_once('view/Cancel/index.php');
    }
    public function indexAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->getIndexPage());
    }
    public function keyAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->getKeysPage());
    }
    public function regAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->getRegPage());
    }

    public function cancelAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->getcancelPage());
    }
    public function discardAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->discardAct());
    }


}