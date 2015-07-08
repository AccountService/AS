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
    private function getCancelPage()
    {
        include_once('view/Cancel/index.php');
    }

    private function markKeyAct()
    {
        include_once('view/MarkKey/index.php');
    }

    private function getBuyPage()
    {
        include_once('view/Buy/index.php');

    }
    private function getTakePage()
    {
        include_once('view/Take/index.php');

    }

    private function getGetPage()
    {
        include_once('view/Get/index.php');
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
        return new \Symfony\Component\HttpFoundation\Response($this->getCancelPage());
    }
    public function discardAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->discardAct());
    }

    public function markAction() {
        return new \Symfony\Component\HttpFoundation\Response($this->markKeyAct());
    }

    public function buyAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->getBuyPage());
    }
    public function getAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->getGetPage());
    }

    public function takeAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->getTakePage());
    }


}