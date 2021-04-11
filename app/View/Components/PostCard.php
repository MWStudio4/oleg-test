<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class PostCard extends Component
{
    public $post;
    public $isAuthUserPost;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Post $post, bool $isAuthUserPost)
    {
        $this->post = $post;
        $this->isAuthUserPost = $isAuthUserPost;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-card');
    }
}
