<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 15/11/2017
 * Time: 21:18
 */
namespace controller;
use view\View;



class ErrorController
{
    private $view;

    /**
     * ErrorController constructor.
     * @param $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function showError(\Exception $e){
        $this->view->error($e);

}
}