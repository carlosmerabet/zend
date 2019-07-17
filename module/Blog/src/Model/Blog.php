<?php

namespace Blog\Model;

class Blog
{
    public $id;
    public $content;
    public $title;
    public $comments;

    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->content = !empty($data['content']) ? $data['content'] : null;
        $this->title  = !empty($data['title']) ? $data['title'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content
        ];
    }    
}