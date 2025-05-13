<?php 

class Article {
    protected $articleId;
    protected $articleTitle;
    protected $articleAuther;
    protected $articleContent;
    protected $articlePublicationDate;
    protected $categoryId;
    protected $articleImg;

    //setters functions
    public function setArticleId($articleId){
        $this->articleId = $articleId;
    }

    public function setArticleTitle($articleTitle){
        $this->articleTitle = $articleTitle;
    }

    public function setArticleAuther($articleAuther){
        $this->articleAuther = $articleAuther;
    }

    public function setArticleContent($articleContent){
        $this->articleContent = $articleContent;
    }

    public function setArticlePublicationDate($articlePublicationDate){
        $this->articlePublicationDate = $articlePublicationDate;
    }

    public function setCategoryId($categoryId){
        $this->categoryId = $categoryId;
    }

    public function setArticleImg($articleImg){
        $this->articleImg = $articleImg;
    }

    //getters functions
    public function getArticleId(){
        return $this->articleId;
    }   

    public function getArticleTitle(){
        return $this->articleTitle;
    }  

    public function getArticleAuther(){
        return $this->articleAuther;
    }   

    public function getArticleContent(){
        return $this->articleContent;
    }

    public function getArticlePublicationDate(){
        return $this->articlePublicationDate;
    } 

    public function getCategoryId(){
        return $this->categoryId;
    } 

    public function getArticleImg(){
        return $this->articleImg;
    } 
}

?>