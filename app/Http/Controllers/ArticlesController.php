<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PortfoliosRepository;
use App\Repositories\ArticlesRepository;
use App\Repositories\CommentsRepository;
use Illuminate\Support\Str;
use App\Category;


class ArticlesController extends SiteController
{

    public function __construct(
        PortfoliosRepository $p_rep,
        ArticlesRepository $a_rep,
        CommentsRepository $c_rep){
        parent::__construct( new \App\Repositories\MenusRepository(new \App\Menu));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;

        $this->template = env('THEME').'.articles';
        $this->bar = 'right';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cat_alias=false)
    {

        $articles = $this->getArticles($cat_alias);

        $content = view(env('THEME').'.articles_content')->with('articles',$articles)->render();

        $this->vars['content'] = $content;

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));

        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments'=>$comments,'portfolios'=>$portfolios]);


        return $this->renderOutput();
    }

    public function getComments($take){

        $comments = $this->c_rep->get(['text','name','email','site','article_id','user_id'],$take);

        //dd($comments);
        if($comments){
            $comments->load('article','user');
        }

        return $comments;

    }

    public function getPortfolios($take){

        $portfolios = $this->p_rep->get(['title','text','alias','customer','img','alias'],$take);

        //dd($portfolios);

        return $portfolios;

    }

    public function getArticles($alias=false){

        $where = false;

        if($alias){

            $id = Category::select('id')->where('alias','=',$alias)->first()->id;
            $where = ['category_id',$id];

        }

        $articles= $this->a_rep->get(['id','title','alias','created_at','img','desc','user_id','category_id'],false,true,$where);

        if($articles){
            $articles->load('user','category','comments');
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
    public function show($alias=false)
    {
        //
        $article = $this->a_rep->one($alias,['comments'=>true]);

        if($article){
            $article->img = json_decode($article->img);
        }
        
        $content = view(env('THEME').'.article_content')->with('article',$article)->render();
        $this->vars['content'] = $content;

        $comments = $this->getComments(config('settings.recent_comments'));
        $portfolios = $this->getPortfolios(config('settings.recent_portfolios'));

        $this->contentRightBar = view(env('THEME').'.articlesBar')->with(['comments'=>$comments,'portfolios'=>$portfolios]);

        return $this->renderOutput();
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
