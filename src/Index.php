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
<<<<<<< HEAD
    private function markKeyAct()
    {
        include_once('view/MarkKey/index.php');
=======
    private function getBuyPage()
    {
        include_once('view/Buy/index.php');
>>>>>>> 738d7f9e10fd919f683190c36d474780a36c957c
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
<<<<<<< HEAD
    public function markAction() {
        return new \Symfony\Component\HttpFoundation\Response($this->markKeyAct());
    }
=======
    public function buyAction(){
        return new \Symfony\Component\HttpFoundation\Response($this->getBuyPage());
    }

>>>>>>> 738d7f9e10fd919f683190c36d474780a36c957c

}