<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PortfoliosRepository;
use App\Repositories\ArticlesRepository;

class ArticlesController extends SiteController
{

    public function __construct(
        PortfoliosRepository $p_rep,
        ArticlesRepository $a_rep){
        parent::__construct( new \App\Repositories\MenusRepository(new \App\Menu));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;

        $this->template = env('THEME').'.articles';
        $this->bar = 'right';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = $this->getArticles();


        return $this->renderOutput();
    }

    public function getArticles($alias=false){

        $articles= $this->a_rep->get(['title','alias','created_at','img','desc'],false,true);

        if($articles){
            //$articles->load('user','category','comments');
        }

        return $articles;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
