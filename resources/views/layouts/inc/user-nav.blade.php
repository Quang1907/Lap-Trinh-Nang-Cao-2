<div id="mainnav">
    @php
        $recusive = new Recusive($categories);
        $html = $recusive->menu();
        class Recusive
        {
            public $html = '';
            public $categories = '';
            public function __construct($categories)
            {
                $this->categories = $categories;
            }
            public function menu($id = 0)
            {
                foreach ($this->categories as $category) {
                    if ($category->parent_id == $id) {
                        $this->html .= '<li>';
                        $this->html .= '<a href="' . route('shop', $category->slug) . '">' . $category->name . '</a>';
                        $this->html .= '<ul class="sub-menu-1">';
                        $this->menu($category->id);
                        $this->html .= '</ul>';
                        $this->html .= '</li>';
                    }
                }
                return $this->html;
            }
        }
    @endphp
    <ul id="nav">
        {!! $html !!}
    </ul>
</div>
